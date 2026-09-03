<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Realisation;
use App\Models\HomeContent;
use App\Models\PageAPropos;
use App\Models\PageServices;
use App\Models\PageRealisations;
use App\Models\PageRessources;
use App\Models\PageDevis;
use App\Models\PageContact;
use App\Models\Certification;
use App\Models\Article;
use App\Models\Document;
use App\Models\Devis;
use App\Models\MessageContact;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NouveauCompteClient;

class SiteController extends Controller
{
    public function accueil()
    {
        $presentation = HomeContent::first();
        $prestations = Service::where('est_epingle', true)->orderBy('ordre')->take(3)->get();
        $epinglees = Realisation::with(['media', 'services'])->where('est_epingle', true)->take(2)->get();
        $recentes = Realisation::with(['media', 'services'])->where('est_epingle', false)->latest()->take(3)->get();
        $realisations = $epinglees->concat($recentes)->take(3);

        return view('site.accueil', compact('presentation', 'prestations', 'realisations'));
    }

    public function aPropos()
    {
        $page = PageAPropos::first();
        $certifications = Certification::orderBy('ordre')->get();
        return view('site.a-propos', compact('page', 'certifications'));
    }

    public function services()
    {
        $page = PageServices::first();
        $services = Service::orderBy('ordre')->get();
        return view('site.services', compact('page', 'services'));
    }

    public function serviceDetail(Service $service)
    {
        $realisationsLiees = $service->realisationsMany()->with('media')->take(3)->get();
        return view('site.service-detail', compact('service', 'realisationsLiees'));
    }

    public function realisations(Request $request)
    {
        $page = PageRealisations::first();
        $query = Realisation::with('services');

        if ($request->filled('service')) {
            $query->whereHas('services', fn ($services) => $services->whereKey($request->service));
        }
        if ($request->filled('type_bien')) {
            $query->where('type_bien', $request->type_bien);
        }

        $realisations = $query->latest()->get();
        $services = Service::orderBy('ordre')->get();

        return view('site.realisations', compact('page', 'realisations', 'services'));
    }

 public function realisationDetail(Realisation $realisation)
{
    $realisationsLiees = Realisation::whereHas('services', fn ($services) => $services->whereKey($realisation->services->first()?->id))
        ->where('id', '!=', $realisation->id)
        ->take(3)
        ->get();

    return view('site.realisation-detail', compact('realisation', 'realisationsLiees'));
}

    public function ressources()
    {
        $page = PageRessources::first();
        $articles = Article::latest('date_publication')->get();
        $documents = Document::latest()->get();
        return view('site.ressources', compact('page', 'articles', 'documents'));
    }

    public function articleDetail(Article $article)
    {
        return view('site.article-detail', compact('article'));
    }

    public function devis()
    {
        $page = PageDevis::first();
        $services = Service::orderBy('ordre')->get();
        return view('site.devis', compact('page', 'services'));
    }

    public function devisStore(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:30',
            'service_id' => 'nullable|exists:services,id',
            'type_bien' => 'required|in:maison,entreprise,collectivite',
            'message' => 'nullable|string',
            'consentement' => 'required',
        ]);

        unset($data['consentement']);
        $data['statut'] = 'recu';

        $authenticatedClient = auth('client')->user();
        if ($authenticatedClient) {
            $client = $authenticatedClient;
        } else {
            $client = Client::where('email', $data['email'])->first();
        }

        $existingClient = (bool) $client;
        $plain = null;

        if (! $client) {
            $plain = Str::random(10);
            $client = Client::create([
                'nom' => $data['nom'],
                'email' => $data['email'],
                'password' => Hash::make($plain),
            ]);

        }

        if ($authenticatedClient) {
            $data['nom'] = $client->nom;
            $data['email'] = $client->email;
        }
        $data['client_id'] = $client->id;

        $devis = Devis::create($data);

        if ($plain !== null) {
            try {
                Mail::to($client->email)->send(new NouveauCompteClient($client->nom, $client->email, $plain));
                Log::info('NouveauCompteClient envoyé à '.$client->email, ['devis_id' => $devis->id]);
            } catch (\Exception $e) {
                Log::error('Envoi mail NouveauCompteClient échoué: '.$e->getMessage(), ['devis_id' => $devis->id]);
            }
        }

        if ($existingClient && ! $authenticatedClient) {
            return redirect()->route('client.login')->with('status', 'Votre demande a été enregistrée. Connectez-vous pour suivre son avancement.');
        }

        return redirect()->route('site.devis')->with('success', $authenticatedClient
            ? 'Votre demande a bien été envoyée.'
            : 'Votre demande a bien été envoyée. Un compte client a été créé et les identifiants vous ont été envoyés par e‑mail.');
    }

    public function contact()
    {
        $page = PageContact::first();
        return view('site.contact', compact('page'));
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string',
            'consentement' => 'required',
        ]);

        unset($data['consentement']);
        $data['statut'] = 'non_lu';
        if ($client = auth('client')->user()) {
            $data['client_id'] = $client->id;
            $data['nom'] = $client->nom;
            $data['email'] = $client->email;
        }

        $message = MessageContact::create($data);

        // Send notification email to admin/owner with Reply-To set to visitor email
        try {
            // Utiliser l'adresse demandée explicitement
            $adminEmail = \App\Models\SiteSetting::where('cle', 'email')->value('valeur') ?? config('mail.from.address') ?? 'meryferdirion@gmail.com';
            if ($adminEmail) {
                    \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\MessageContactNotification($message->toArray()));
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send contact notification: ' . $e->getMessage());
        }

        return redirect()->route('site.contact')->with('success', 'Votre message a bien été envoyé.');
    }
}