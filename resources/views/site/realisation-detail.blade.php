@extends('layouts.site')
@section('title', $realisation->titre)
@section('content')

    <div class="pt-24 sm:pt-32 px-4 sm:px-6 max-w-6xl mx-auto text-sm text-gray-500">
        <a href="{{ route('site.accueil') }}" class="hover:text-brand-blue">Accueil</a> /
        <a href="{{ route('site.realisations') }}" class="hover:text-brand-blue">Réalisations</a> /
        <span class="text-gray-700">{{ $realisation->titre }}</span>
    </div>

    @php $principale = $realisation->media->firstWhere('est_principale', true) ?? $realisation->media->first(); @endphp

    <section class="relative overflow-hidden mt-6">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/95 to-slate-900/70"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.24),_transparent_35%)]"></div>
        <div class="relative max-w-6xl mx-auto grid gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="space-y-6 text-white">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    Réalisation de qualité
                </span>
                <h1 class="text-4xl font-extrabold leading-tight sm:text-5xl">{{ $realisation->titre }}</h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-200">
                    {{ $realisation->lieu }} @if($realisation->date_realisation) · {{ \Carbon\Carbon::parse($realisation->date_realisation)->translatedFormat('F Y') }} @endif
                </p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                        <div class="text-sm uppercase tracking-[0.25em] text-slate-300">Services</div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @forelse($realisation->services as $service)
                                <span class="rounded-full bg-white/10 px-3 py-1 text-sm font-semibold">{{ $service->titre }}</span>
                            @empty
                                <span class="text-lg font-semibold">Non précisé</span>
                            @endforelse
                        </div>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                        <div class="text-sm uppercase tracking-[0.25em] text-slate-300">Type de bien</div>
                        <div class="mt-3 text-lg font-semibold capitalize">{{ $realisation->type_bien }}</div>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/20">
                @if($principale)
                    <img src="{{ Storage::url($principale->path) }}" alt="{{ $realisation->titre }}" class="h-full w-full min-h-[360px] object-cover rounded-[1.5rem]" />
                @else
                    <div class="flex h-full min-h-[360px] items-center justify-center rounded-[1.5rem] bg-slate-900 text-slate-300">
                        Image indisponible
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16 space-y-16">
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr] lg:items-start">
            <div class="space-y-10">
                <div class="rounded-[2rem] bg-white p-10 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.15)]">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-brand-orange/10 text-brand-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2a1 1 0 0 1 .993.883L13 3v7h7a1 1 0 0 1 .117 1.993L20 12h-7v7a1 1 0 0 1-1.993.117L11 19v-7H3a1 1 0 0 1-.117-1.993L3 10h7V3a1 1 0 0 1 1-1z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Description du projet</p>
                            <h2 class="text-3xl font-semibold text-brand-dark">Détails de l’intervention</h2>
                        </div>
                    </div>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        {!! $realisation->description_longue !!}
                    </div>
                </div>

                @if($realisation->media->count() > 0)
                @php
                    $gallery = $realisation->media->sortBy('ordre')->map(function ($media) {
                        return [
                            'type' => $media->type,
                            'src' => Storage::url($media->path),
                        ];
                    })->values()->all();
                @endphp

                <section class="rounded-[2rem] bg-slate-950 p-6 text-white shadow-[0_32px_80px_-40px_rgba(15,23,42,0.25)]" x-data="{ open: false, current: 0, media: @js($gallery) }">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Galerie du projet</p>
                            <h3 class="text-2xl font-semibold">Visuels terrain</h3>
                        </div>
                        <span class="text-sm text-slate-400">{{ $realisation->media->count() }} éléments</span>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($realisation->media->sortBy('ordre') as $index => $media)
                            <button type="button" @click="open = true; current = {{ $index }}" class="group overflow-hidden rounded-[1.5rem] border border-white/10 bg-slate-900 text-left transition duration-300 hover:border-orange-400/80 hover:shadow-lg hover:shadow-orange-500/10">
                                @if($media->type === 'video')
                                    <div class="relative">
                                        <video class="h-48 w-full object-cover opacity-90 transition duration-300 group-hover:scale-105">
                                            <source src="{{ Storage::url($media->path) }}">
                                        </video>
                                        <div class="absolute inset-0 flex items-center justify-center bg-slate-950/20">
                                            <span class="flex h-12 w-12 items-center justify-center rounded-full bg-white/80 text-slate-950 shadow-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M8 5v14l11-7L8 5z" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <img src="{{ Storage::url($media->path) }}" alt="{{ $realisation->titre }}" class="h-48 w-full object-cover transition duration-300 group-hover:scale-105">
                                @endif
                            </button>
                        @endforeach
                    </div>

                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/85 px-4 py-8 backdrop-blur-sm" @keydown.escape.window="open = false">
                        <div class="relative w-full max-w-5xl overflow-hidden rounded-[2rem] border border-white/10 bg-slate-900 shadow-2xl shadow-slate-950/50">
                            <button type="button" @click="open = false" class="absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-xl text-white transition hover:bg-white/20">
                                ×
                            </button>

                            <div class="relative flex items-center justify-center bg-slate-950">
                                <button type="button" @click="current = (current - 1 + media.length) % media.length" class="absolute left-4 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-2xl text-white transition hover:bg-white/20">
                                    ‹
                                </button>

                                <div class="flex max-h-[78vh] w-full items-center justify-center bg-slate-950 p-4 sm:p-6">
                                    <template x-if="media[current]?.type === 'video'">
                                        <video controls autoplay class="max-h-[76vh] w-full rounded-[1.25rem] object-contain bg-slate-950">
                                            <source :src="media[current].src">
                                        </video>
                                    </template>

                                    <template x-if="media[current]?.type !== 'video'">
                                        <img :src="media[current].src" alt="Vue agrandie" class="max-h-[76vh] w-full rounded-[1.25rem] object-contain">
                                    </template>
                                </div>

                                <button type="button" @click="current = (current + 1) % media.length" class="absolute right-4 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-2xl text-white transition hover:bg-white/20">
                                    ›
                                </button>
                            </div>

                            <div class="flex items-center justify-between gap-4 border-t border-white/10 bg-slate-950/80 px-6 py-4 text-sm text-slate-300">
                                <span x-text="(current + 1) + ' / ' + media.length"></span>
                                <span x-text="media[current]?.type === 'video' ? 'Vidéo' : 'Image'" class="uppercase tracking-[0.2em]"></span>
                            </div>
                        </div>
                    </div>
                </section>
                @endif

                @if($realisationsLiees->count())
                <div class="rounded-[2rem] bg-slate-950 p-6 text-white shadow-[0_32px_80px_-40px_rgba(15,23,42,0.25)]">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Réalisations associées</p>
                            <h3 class="text-2xl font-semibold">Projets similaires</h3>
                        </div>
                        <span class="text-sm text-slate-400">{{ $realisationsLiees->count() }} projets</span>
                    </div>
                    <div class="-mx-4 overflow-x-auto pb-4 scrollbar-thin scrollbar-thumb-slate-700/50 scrollbar-track-slate-950/0">
                        <div class="inline-flex gap-4 px-4">
                            @foreach($realisationsLiees as $r)
                            @php $thumb = $r->media->firstWhere('est_principale', true) ?? $r->media->first(); @endphp
                            <a href="{{ route('site.realisations.show', $r) }}" class="min-w-[280px] snap-start rounded-[1.75rem] border border-white/10 bg-white/5 p-5 transition hover:bg-white/10">
                                <div class="mb-4 overflow-hidden rounded-[1.5rem] bg-slate-900">
                                    @if($thumb)
                                    <img src="{{ Storage::url($thumb->path) }}" class="h-40 w-full object-cover" alt="{{ $r->titre }}">
                                    @else
                                    <div class="flex h-40 items-center justify-center bg-slate-800 text-slate-400">Pas d’image</div>
                                    @endif
                                </div>
                                <h4 class="text-lg font-semibold text-white mb-2">{{ $r->titre }}</h4>
                                <p class="text-sm text-slate-300">{{ Illuminate\Support\Str::limit($r->lieu ?? 'Localisation non précisée', 60) }}</p>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <aside class="space-y-8">
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)]">
                    <h3 class="text-base font-semibold uppercase tracking-[0.2em] text-slate-400">Caractéristiques</h3>
                    <div class="mt-6 space-y-5 text-sm text-slate-600">
                        <div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Client</div>
                            <div class="mt-2 font-semibold text-brand-dark">{{ $realisation->client ?? 'Confidentiel' }}</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Puissance</div>
                            <div class="mt-2 font-semibold text-brand-dark">{{ $realisation->kwc }} kWc</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Localisation</div>
                            <div class="mt-2 font-semibold text-brand-dark">{{ $realisation->lieu }}</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Date</div>
                            <div class="mt-2 font-semibold text-brand-dark">{{ $realisation->date_realisation ? \Carbon\Carbon::parse($realisation->date_realisation)->translatedFormat('F Y') : 'Non précisée' }}</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Type de bien</div>
                            <div class="mt-2 font-semibold text-brand-dark capitalize">{{ $realisation->type_bien }}</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-slate-200/70 bg-gradient-to-b from-white to-slate-50 p-8 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)]">
                    <h3 class="text-base font-semibold uppercase tracking-[0.2em] text-slate-400">Besoin d’un projet similaire ?</h3>
                    <p class="mt-4 text-sm text-slate-600">Notre équipe peut reproduire ce niveau de qualité pour votre installation solaire, avec un accompagnement technique complet.</p>
                    <a href="{{ route('site.devis') }}?service={{ $realisation->service_id }}" class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-brand-orange px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-orange/20 hover:bg-orange-500 transition">
                        Demander un devis
                    </a>
                </div>
            </aside>
        </div>
    </section>

@endsection