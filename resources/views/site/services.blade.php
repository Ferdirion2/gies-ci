@extends('layouts.site')
@section('title', 'Services')
@section('content')

    <section class="relative isolate overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/pages/services.jpg') }}"
                alt="Installation solaire"
                class="h-full w-full object-cover" />

            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
        </div>

        <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-24">
            <div class="w-full text-left">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    Nos services • Solutions solaires
                </span>

                <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                    Nos services
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                    {{ $page?->texte_intro ?? "Des solutions solaires adaptées à chaque besoin." }}
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-20">
        <div class="grid md:grid-cols-3 gap-8 items-stretch">
            @forelse($services as $service)
            <a href="{{ route('site.services.show', $service) }}"
                class="group flex flex-col h-full bg-white rounded-2xl p-8 border border-gray-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                <div class="w-12 h-12 rounded-xl bg-brand-blue/10 flex items-center justify-center mb-5 shrink-0">
                    <x-dynamic-component :component="$service->icone ?? 'heroicon-o-sun'" class="h-6 w-6" />
                </div>

                <h3 class="font-semibold text-lg mb-2 text-brand-dark group-hover:text-brand-blue transition-colors">
                    {{ $service->titre }}
                </h3>

                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                    {{ $service->description_courte }}
                </p>

                <span class="mt-6 pt-4 border-t border-gray-100 text-sm font-semibold text-brand-orange">
                    En savoir plus →
                </span>
            </a>
            @empty
            <p class="text-gray-500 col-span-3 text-center">Aucun service pour le moment.</p>
            @endforelse
        </div>
    </section>

@endsection