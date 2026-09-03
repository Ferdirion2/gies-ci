@extends('layouts.site')
@section('title', 'Mon espace client')
@section('content')

@php
    $user = auth('client')->user();
    $devis = $user->devis()->latest()->take(5)->get();
    $messages = $user->messages()->latest()->take(3)->get();

    $statutsDevis = [
        'recu' => ['label' => 'Reçu', 'color' => 'bg-slate-100 text-slate-700'],
        'en_cours_etude' => ['label' => 'En cours d\'étude', 'color' => 'bg-amber-100 text-amber-700'],
        'chiffre' => ['label' => 'Chiffré', 'color' => 'bg-blue-100 text-blue-700'],
        'accepte' => ['label' => 'Accepté', 'color' => 'bg-emerald-100 text-emerald-700'],
        'refuse' => ['label' => 'Refusé', 'color' => 'bg-red-100 text-red-700'],
    ];

    $statutsMessages = [
        'non_lu' => ['label' => 'Non lu', 'color' => 'bg-red-100 text-red-700'],
        'lu' => ['label' => 'Lu', 'color' => 'bg-amber-100 text-amber-700'],
        'traite' => ['label' => 'Traité', 'color' => 'bg-emerald-100 text-emerald-700'],
    ];
@endphp

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
    <div class="grid grid-cols-1 xl:grid-cols-[260px_minmax(0,1fr)] gap-6">

        <aside class="rounded-[28px] bg-slate-950 text-white p-6 shadow-[0_22px_60px_rgba(15,23,42,0.18)] h-fit xl:sticky xl:top-24">
            <div class="flex items-center gap-3 mb-8">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500/15 text-orange-400 text-base font-bold">
                    {{ strtoupper(substr($user->nom, 0, 1)) }}
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.26em] text-slate-400">Compte</p>
                    <h2 class="text-lg font-semibold">{{ $user->nom }}</h2>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('client.dashboard') }}" class="flex items-center gap-3 rounded-2xl bg-white/5 px-3 py-3 text-sm font-medium text-white ring-1 ring-white/10">
                    <span>🏠</span> Dashboard
                </a>
                <a href="#demandes" class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white transition">
                    <span>📋</span> Mes demandes
                </a>
                <a href="#messages" class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white transition">
                    <span>💬</span> Mes messages
                </a>
                <a href="{{ route('client.password.edit') }}" class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white transition">
                    <span>🔐</span> Mot de passe
                </a>
            </nav>

            <div class="mt-8 pt-6 border-t border-white/10">
                <p class="text-[10px] uppercase tracking-[0.22em] text-slate-400 mb-3">Accès rapide</p>
                <div class="space-y-2 text-sm text-slate-300">
                    <a href="{{ route('site.devis') }}" class="block hover:text-white transition">Créer une demande</a>
                    <a href="{{ route('site.contact') }}" class="block hover:text-white transition">Contacter le support</a>
                </div>
            </div>

            <form method="POST" action="{{ route('client.logout') }}" class="mt-8">
                @csrf
                <button type="submit" class="w-full rounded-2xl border border-white/15 bg-transparent px-3 py-3 text-sm font-medium text-slate-200 hover:border-orange-400 hover:text-white transition">
                    Se déconnecter
                </button>
            </form>
        </aside>

        <div class="space-y-6">
            <section class="rounded-[30px] bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800 p-6 md:p-8 text-white shadow-[0_22px_60px_rgba(15,23,42,0.18)]">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.28em] text-orange-300">Espace client</p>
                        <h1 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Bonjour, {{ $user->nom }}</h1>
                        <p class="mt-2 text-sm text-slate-300">Voici le suivi de vos demandes et échanges.</p>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 backdrop-blur-sm">
                        <div class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Aujourd'hui</div>
                        <div class="mt-2 text-base font-semibold text-white">{{ now()->translatedFormat('d F Y') }}</div>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Mes demandes</p>
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 text-lg">📋</span>
                    </div>
                    <div class="mt-5 text-4xl font-bold text-slate-900">{{ $user->devis()->count() }}</div>
                </div>

                <div class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Demandes en cours</p>
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg">⏳</span>
                    </div>
                    <div class="mt-5 text-4xl font-bold text-slate-900">{{ $user->devis()->where('statut', 'en_cours_etude')->count() }}</div>
                </div>

                <div class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Messages non lus</p>
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 text-lg">💬</span>
                    </div>
                    <div class="mt-5 text-4xl font-bold text-slate-900">{{ \App\Models\MessageContact::where('email', $user->email)->where('statut', 'non_lu')->count() }}</div>
                </div>
            </section>

            <section id="demandes" class="rounded-[30px] border border-slate-200 bg-white p-5 md:p-6 shadow-sm">
                <div class="mb-5 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Suivi</p>
                        <h2 class="mt-1 text-2xl font-bold text-slate-900">Mes demandes</h2>
                    </div>
                    <a href="{{ route('site.devis') }}" class="inline-flex items-center rounded-full bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-500/20 hover:bg-orange-400 transition">
                        Nouvelle demande
                    </a>
                </div>

                @if($devis->isEmpty())
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-slate-500">
                        Vous n'avez pas encore de demande de devis.
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($devis as $d)
                            <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <div class="font-semibold text-slate-900">{{ $d->service?->titre ?? 'Service non précisé' }}</div>
                                    <div class="mt-1 text-sm text-slate-500">Envoyé le {{ $d->created_at->format('d/m/Y') }}</div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex rounded-full px-3 py-1.5 text-xs font-semibold {{ $statutsDevis[$d->statut]['color'] ?? 'bg-slate-100 text-slate-700' }}">
                                        {{ $statutsDevis[$d->statut]['label'] ?? ucfirst($d->statut) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <section id="messages" class="rounded-[30px] border border-slate-200 bg-white p-5 md:p-6 shadow-sm">
                <div class="mb-5 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Communication</p>
                        <h2 class="mt-1 text-2xl font-bold text-slate-900">Mes messages</h2>
                    </div>
                    <a href="{{ route('site.contact') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition">
                        Nouveau message
                    </a>
                </div>

                @if($messages->isEmpty())
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-slate-500">
                        Aucun message récent.
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($messages as $m)
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <div class="font-semibold text-slate-900">{{ $m->sujet }}</div>
                                        <div class="mt-1 text-sm text-slate-500">{{ $m->created_at->format('d/m/Y à H:i') }}</div>
                                    </div>
                                    <span class="inline-flex rounded-full px-3 py-1.5 text-xs font-semibold {{ $statutsMessages[$m->statut]['color'] ?? 'bg-slate-100 text-slate-700' }}">
                                        {{ $statutsMessages[$m->statut]['label'] ?? ucfirst($m->statut) }}
                                    </span>
                                </div>
                                <p class="mt-3 text-sm text-slate-600">{{ Str::limit($m->message, 150) }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </div>
</section>

@endsection