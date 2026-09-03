<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\MessageContact;

class DashboardController extends Controller
{
    public function index()
    {
        $client = auth('client')->user();

        $stats = [
            'total' => $client->devis()->count(),
            'en_cours' => $client->devis()->where('statut', 'en_cours_etude')->count(),
            'non_lu_messages' => $client->messages()->where('statut', 'non_lu')->count(),
        ];

        $devis = $client->devis()->with('service')->latest()->take(5)->get();
        $messages = $client->messages()->latest()->take(3)->get();

        return view('client.dashboard', compact('client', 'stats', 'devis', 'messages'));
    }

    public function requests()
    {
        $client = auth('client')->user();
        $devis = $client->devis()->with('service')->latest()->paginate(10);
        return view('client.requests', compact('client', 'devis'));
    }

    public function messages()
    {
        $client = auth('client')->user();
        $messages = $client->messages()->latest()->paginate(10);
        return view('client.messages', compact('client', 'messages'));
    }
}
