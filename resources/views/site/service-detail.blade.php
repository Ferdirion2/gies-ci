@extends('layouts.site')
@section('title', $service->titre)
@section('content')

    <div class="pt-24 sm:pt-32 px-4 sm:px-6 max-w-6xl mx-auto text-sm text-gray-500">
        <a href="{{ route('site.accueil') }}" class="hover:text-brand-blue">Accueil</a> /
        <a href="{{ route('site.services') }}" class="hover:text-brand-blue">Services</a> /
        <span class="text-gray-700">{{ $service->titre }}</span>
    </div>

    <section class="relative overflow-hidden mt-6">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/95 to-slate-900/70"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.24),_transparent_35%)]"></div>
        <div class="relative max-w-6xl mx-auto grid gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="space-y-6 text-white">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    Service premium
                </span>
                <h1 class="text-4xl font-extrabold leading-tight sm:text-5xl">{{ $service->titre }}</h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-200">
                    {{ $service->description_courte ?? 'Un service expert, conçu pour vous apporter performance et sérénité.' }}
                </p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                        <div class="text-sm uppercase tracking-[0.25em] text-slate-300">Objectif</div>
                        <div class="mt-3 text-lg font-semibold">Optimiser votre installation</div>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                        <div class="text-sm uppercase tracking-[0.25em] text-slate-300">Résultat</div>
                        <div class="mt-3 text-lg font-semibold">Performance durable</div>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/20">
                @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->titre }}" class="h-full w-full min-h-[360px] object-cover rounded-[1.5rem]" />
                @else
                    <div class="flex h-full min-h-[360px] items-center justify-center rounded-[1.5rem] bg-slate-900 text-slate-300">
                        Image du service indisponible
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 space-y-16">
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr] lg:items-start">
            <div class="space-y-8">
                @if($service->description_longue)
                    <div class="rounded-[2rem] bg-white p-12 shadow-[0_36px_80px_-40px_rgba(15,23,42,0.15)]">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-brand-orange/10 text-brand-orange">
                                <x-dynamic-component :component="$service->icone ?? 'heroicon-o-sun'" class="h-6 w-6" />
                            </div>
                            <div>
                                <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Présentation détaillée</p>
                                <h2 class="text-3xl font-semibold text-brand-dark">Une approche rigoureuse et technique</h2>
                            </div>
                        </div>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                            {!! $service->description_longue !!}
                        </div>
                    </div>
                @endif

                @if($service->points_cles)
                    <div class="rounded-[2rem] bg-slate-950 p-10 text-white shadow-[0_36px_80px_-40px_rgba(15,23,42,0.25)]">
                        <div class="flex items-center justify-between gap-4 mb-8">
                            <div>
                                <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Prestations</p>
                                <h3 class="mt-3 text-2xl font-semibold">Ce que nous réalisons</h3>
                            </div>
                            <span class="inline-flex rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-[0.25em] text-white/70">Expertise terrain</span>
                        </div>
                        <ul class="grid gap-4 sm:grid-cols-2">
                            @foreach(explode("\n", $service->points_cles) as $point)
                                @if(trim($point))
                                <li class="rounded-3xl border border-white/10 bg-white/5 p-5 text-sm leading-7 transition hover:bg-white/10">
                                    <div class="flex items-start gap-3">
                                        <span class="mt-1 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-2xl bg-orange-500 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M20.285 6.707a1 1 0 0 0-1.414-1.414L9 14.164l-3.871-3.871a1 1 0 0 0-1.414 1.414l4.578 4.579a1 1 0 0 0 1.414 0l10.578-10.579z" />
                                            </svg>
                                        </span>
                                        <span>{{ trim($point) }}</span>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <aside class="space-y-8">
                <div class="rounded-[2rem] border border-slate-200/70 bg-white p-8 shadow-[0_36px_80px_-40px_rgba(15,23,42,0.12)]">
                    <h3 class="text-base font-semibold uppercase tracking-[0.2em] text-slate-400">Détails du service</h3>
                    <div class="mt-6 space-y-5 text-sm text-slate-600">
                        <div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Durée estimée</div>
                            <div class="mt-2 font-semibold text-brand-dark">Personnalisée selon le projet</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Objectif</div>
                            <div class="mt-2 font-semibold text-brand-dark">Rendement et fiabilité</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Accompagnement</div>
                            <div class="mt-2 font-semibold text-brand-dark">Du devis à la maintenance</div>
                        </div>
                    </div>
                </div>

                @if($realisationsLiees->count())
                <div class="rounded-[2rem] bg-slate-950 p-8 text-white shadow-[0_36px_80px_-40px_rgba(15,23,42,0.25)]">
                    <h3 class="text-lg font-semibold mb-5">Réalisations associées</h3>
                    <div class="space-y-4">
                        @foreach($realisationsLiees as $r)
                        <a href="{{ route('site.realisations.show', $r) }}" class="block rounded-[1.75rem] border border-white/10 bg-white/5 p-5 transition hover:bg-white/10">
                            <p class="font-medium text-white">{{ $r->titre }}</p>
                            <p class="text-sm text-slate-300">Voir le projet</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>

        <div class="rounded-[2rem] bg-gradient-to-r from-brand-orange/10 via-brand-orange/5 to-white/60 border border-brand-orange/20 p-10 shadow-[0_36px_80px_-40px_rgba(249,115,22,0.18)]">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-brand-dark/70">Prêt à passer à l’action ?</p>
                    <p class="mt-3 text-3xl font-semibold text-brand-dark">Un projet solaire haut de gamme, réalisé sans compromis.</p>
                </div>
                <a href="{{ route('site.devis') }}?service={{ $service->id }}" class="inline-flex items-center justify-center rounded-full bg-brand-orange px-9 py-4 text-sm font-semibold text-white shadow-lg shadow-brand-orange/25 hover:bg-orange-500 transition">
                    Demander un devis personnalisé
                </a>
            </div>
        </div>
    </section>

@endsection