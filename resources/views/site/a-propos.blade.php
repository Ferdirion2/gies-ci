@extends('layouts.site')
@section('title', 'À propos')
@section('content')

    <section class="relative isolate overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/pages/a-propos.jpg') }}"
                alt="Installation solaire"
                class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
        </div>
        <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-24">
            <div class="w-full text-left">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    À propos • Notre histoire
                </span>
                <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                    À propos de GIES-CI
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                   Une expertise engagée au service de l’énergie et de l’innovation. Découvrez notre histoire, notre vision, nos missions et les valeurs qui guident GIES-CI dans la réalisation de solutions énergétiques fiables et durables.
                </p>
            </di
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 py-16 md:py-20">
        <div class="space-y-16">
            @if($page?->histoire)
            <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
                <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">Notre histoire</span>
                <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">{!! $page->histoire !!}</div>
            </div>
            @endif

            @if($page?->mission_valeurs)
            <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
                <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">Mission et valeurs</span>
                <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">{!! $page->mission_valeurs !!}</div>
            </div>
            @endif

            @if($page?->texte_equipe)
            <div class="grid items-center gap-10 rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:grid-cols-2 lg:p-10">
                <div>
                    <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">Notre équipe</span>
                    <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">{!! $page->texte_equipe !!}</div>
                </div>
                @if($page->photo_equipe)
                    <img src="{{ Storage::url($page->photo_equipe) }}" class="h-full w-full rounded-2xl object-cover" alt="Équipe GIES-CI">
                @endif
            </div>
            @endif

            @if($certifications->count())
            <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
                <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">Garanties et certifications</span>
                <div class="mt-5 flex flex-wrap gap-4">
                    @foreach($certifications as $c)
                    <div class="border border-gray-200 rounded-xl px-5 py-3 text-sm font-medium text-brand-dark">
                        {{ $c->nom }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

@endsection