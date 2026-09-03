@extends('layouts.site')
@section('title', 'Ressources')
@section('content')

    <section class="relative isolate overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/pages/ressources.jpg') }}"
                alt="Installation solaire"
                class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
        </div>
        <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-24">
            <div class="w-full text-left">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    Ressources • Guides et conseils
                </span>
                <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                    Ressources
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                    {{ $page?->texte_intro ?? "Articles et documents pour mieux comprendre l'énergie solaire." }}
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16">
        <h2 class="text-2xl font-bold text-brand-dark mb-8">Articles</h2>
        <div class="grid sm:grid-cols-2 gap-8 mb-20">
            @forelse($articles as $article)
            <article class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="h-48 overflow-hidden bg-gray-100">
                    @if($article->image_couverture)
                        <img src="{{ Storage::url($article->image_couverture) }}" alt="{{ $article->titre }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    @endif
                </div>
                <div class="p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-blue">
                        {{ $article->categorie ?? 'Article' }}
                    </p>
                    <h3 class="mt-3 text-xl font-semibold text-brand-dark transition-colors group-hover:text-brand-blue">
                        {{ $article->titre }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($article->date_publication)->translatedFormat('d F Y') }}
                    </p>
                    <p class="mt-4 text-sm leading-7 text-gray-600">
                        {{ $article->extrait ?: Str::limit(strip_tags($article->contenu), 180) }}
                    </p>
                    <a href="{{ route('site.articles.show', $article) }}" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-brand-blue hover:text-brand-orange">
                        Lire l'article
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </article>
            @empty
            <p class="text-gray-500">Aucun article pour le moment.</p>
            @endforelse
        </div>

        <h2 class="text-2xl font-bold text-brand-dark mb-8">Documents</h2>
        <div class="space-y-3">
            @forelse($documents as $document)
            <a href="{{ Storage::url($document->fichier) }}" target="_blank"
                class="flex items-center justify-between border border-gray-200 rounded-xl px-6 py-4 hover:border-brand-blue transition-colors">
                <div>
                    <div class="font-medium text-brand-dark">{{ $document->titre }}</div>
                    <div class="text-xs text-gray-500">{{ $document->categorie }}</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-brand-blue" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 3a1 1 0 0 1 1 1v8h4a1 1 0 0 1 .707 1.707l-6 6a1 1 0 0 1-1.414 0l-6-6A1 1 0 0 1 7 12h4V4a1 1 0 0 1 1-1z" />
                </svg>
            </a>
            @empty
            <p class="text-gray-500">Aucun document pour le moment.</p>
            @endforelse
        </div>
    </section>

@endsection