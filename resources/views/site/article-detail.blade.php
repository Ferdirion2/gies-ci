@extends('layouts.site')
@section('title', $article->titre)
@section('content')

    @php
        $gallery = $article->media->sortBy('ordre')->map(function ($media) {
            return [
                'type' => $media->type,
                'src' => Storage::url($media->path),
            ];
        })->values()->all();
    @endphp

    <div class="mx-auto max-w-6xl px-4 pt-10 text-sm text-gray-500 sm:px-6 sm:pt-14">
        <a href="{{ route('site.accueil') }}" class="hover:text-brand-blue">Accueil</a> /
        <a href="{{ route('site.ressources') }}" class="hover:text-brand-blue">Ressources</a> /
        <span class="text-gray-700">{{ $article->titre }}</span>
    </div>

    <section class="relative mt-10 overflow-hidden sm:mt-12">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/95 to-slate-900/70"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.24),_transparent_35%)]"></div>
        <div class="relative mx-auto grid max-w-6xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="space-y-6 text-white">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    {{ $article->categorie ?? 'Article' }}
                </span>
                <h1 class="text-4xl font-extrabold leading-tight sm:text-5xl">{{ $article->titre }}</h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-200">
                    {{ \Carbon\Carbon::parse($article->date_publication)->translatedFormat('d F Y') }}
                </p>
                @if($article->extrait)
                    <p class="max-w-2xl text-base leading-8 text-slate-200/90">
                        {{ $article->extrait }}
                    </p>
                @endif
            </div>

            <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/20">
                @if($article->image_couverture)
                    <img src="{{ Storage::url($article->image_couverture) }}" alt="{{ $article->titre }}" class="h-full w-full min-h-[360px] rounded-[1.5rem] object-cover" />
                @else
                    <div class="flex h-full min-h-[360px] items-center justify-center rounded-[1.5rem] bg-slate-900 text-slate-300">
                        Image indisponible
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if($article->media->count())
        <section class="mx-auto mt-12 max-w-6xl px-4 pb-6 sm:px-6 sm:mt-16" x-data="{ open: false, current: 0, media: @js($gallery) }">
            <div class="rounded-[2rem] bg-slate-950 p-6 text-white shadow-[0_32px_80px_-40px_rgba(15,23,42,0.25)] sm:p-8">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Galerie</p>
                        <h3 class="text-2xl font-semibold">Images et vidéos</h3>
                    </div>
                    <span class="text-sm text-slate-400">{{ $article->media->count() }} éléments</span>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($article->media->sortBy('ordre') as $index => $media)
                        <button type="button" @click="open = true; current = {{ $index }}" class="group overflow-hidden rounded-[1.5rem] border border-white/10 bg-slate-900 text-left transition duration-300 hover:border-orange-400/80 hover:shadow-lg hover:shadow-orange-500/10">
                            @if($media->type === 'video')
                                <div class="relative">
                                    <video class="h-64 w-full object-cover opacity-90 transition duration-300 group-hover:scale-105">
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
                                <img src="{{ Storage::url($media->path) }}" alt="{{ $article->titre }}" class="h-64 w-full object-cover transition duration-300 group-hover:scale-105">
                            @endif
                        </button>
                    @endforeach
                </div>
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

    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <div class="grid gap-10 lg:grid-cols-[2fr_1fr] lg:items-start">
            <div class="space-y-10">
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.15)] sm:p-10">
                    <div class="mb-8 flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-brand-orange/10 text-brand-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2a1 1 0 0 1 .993.883L13 3v7h7a1 1 0 0 1 .117 1.993L20 12h-7v7a1 1 0 0 1-1.993.117L11 19v-7H3a1 1 0 0 1-.117-1.993L3 10h7V3a1 1 0 0 1 1-1z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Contenu</p>
                            <h2 class="text-3xl font-semibold text-brand-dark">Détails de l'article</h2>
                        </div>
                    </div>

                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed prose-headings:text-brand-dark prose-p:text-slate-700 prose-a:text-brand-blue prose-strong:text-slate-900 prose-li:text-slate-700">
                        {!! $article->contenu !!}
                    </div>
                </div>
            </div>

            <aside class="space-y-8">
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)]">
                    <h3 class="text-base font-semibold uppercase tracking-[0.16em] text-slate-400">Fiche article</h3>

                    <div class="mt-6 space-y-5">
                        <div>
                            <div class="text-xs uppercase tracking-[0.22em] text-slate-400">Catégorie</div>
                            <div class="mt-2 text-lg font-semibold text-brand-dark">{{ $article->categorie ?? 'Article' }}</div>
                        </div>

                        <div>
                            <div class="text-xs uppercase tracking-[0.22em] text-slate-400">Date</div>
                            <div class="mt-2 text-lg font-semibold text-brand-dark">
                                {{ \Carbon\Carbon::parse($article->date_publication)->translatedFormat('d F Y') }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs uppercase tracking-[0.22em] text-slate-400">Résumé</div>
                            <p class="mt-2 text-sm leading-7 text-slate-600">
                                {{ $article->extrait ?: 'Article publié par GIES-CI.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-slate-950 p-8 text-white shadow-[0_32px_80px_-40px_rgba(15,23,42,0.25)]">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-400">Ressources</p>
                    <h3 class="mt-3 text-2xl font-semibold">Autres contenus</h3>
                    <a href="{{ route('site.ressources') }}" class="mt-6 inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-brand-orange hover:text-white">
                        Retour aux ressources
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </aside>
        </div>
    </section>

@endsection
