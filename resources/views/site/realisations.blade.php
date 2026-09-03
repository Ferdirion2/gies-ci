@extends('layouts.site')
@section('title', 'Réalisations')
@section('content')

    <section class="relative isolate overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/pages/realisations.jpg') }}"
                alt="Installation solaire"
                class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
        </div>
        <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-24">
            <div class="w-full text-left">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    Réalisations • Projets réussis
                </span>
                <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                    Nos réalisations
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                    {{ $page?->texte_intro ?? "Des projets solaires réalisés partout." }}
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16">
        <div class="mb-12 rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)]">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Filtrer les projets</p>
                    <h2 class="mt-2 text-3xl font-semibold text-brand-dark">Découvrez nos réalisations</h2>
                </div>
                <p class="text-sm text-slate-500">{{ $realisations->count() }} projet{{ $realisations->count() > 1 ? 's' : '' }} affiché{{ $realisations->count() > 1 ? 's' : '' }}</p>
            </div>

            <form method="GET" class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-[1.2fr_1fr_1fr] xl:grid-cols-[1.4fr_1fr_1fr] items-end">
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Service</label>
                    <select name="service" onchange="this.form.submit()" class="w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-brand-blue focus:ring-brand-blue/20">
                        <option value="">Tous les services</option>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}" @selected(request('service') == $s->id)>{{ $s->titre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Type de bien</label>
                    <select name="type_bien" onchange="this.form.submit()" class="w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-brand-blue focus:ring-brand-blue/20">
                        <option value="">Tous les types de bien</option>
                        <option value="maison" @selected(request('type_bien') == 'maison')>Maison individuelle</option>
                        <option value="entreprise" @selected(request('type_bien') == 'entreprise')>Entreprise</option>
                        <option value="collectivite" @selected(request('type_bien') == 'collectivite')>Collectivité</option>
                    </select>
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-brand-orange px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-orange/15 hover:bg-orange-500 transition">
                        Appliquer
                    </button>
                </div>
            </form>
        </div>

        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($realisations as $realisation)
            @php $image = $realisation->media->firstWhere('est_principale', true) ?? $realisation->media->first(); @endphp
            <a href="{{ route('site.realisations.show', $realisation) }}" class="group overflow-hidden rounded-[2rem] border border-slate-200/70 bg-white shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] transition hover:-translate-y-1 hover:shadow-[0_32px_80px_-40px_rgba(15,23,42,0.18)]">
                <div class="relative h-72 overflow-hidden bg-slate-100">
                    @if($image)
                        <img src="{{ Storage::url($image->path) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" alt="{{ $realisation->titre }}">
                    @else
                        <div class="flex h-full items-center justify-center bg-slate-200 text-slate-500">Pas d’image</div>
                    @endif
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/90 to-transparent px-5 py-4 text-white">
                        <div class="flex flex-wrap gap-2 text-xs uppercase tracking-[0.22em] text-slate-300">
                            @forelse($realisation->services as $service)
                                <span>{{ $service->titre }}</span>
                            @empty
                                <span>Projet</span>
                            @endforelse
                        </div>
                        <h3 class="mt-2 text-xl font-semibold">{{ $realisation->titre }}</h3>
                    </div>
                </div>
                <div class="space-y-4 p-6">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center rounded-full bg-brand-blue/10 px-3 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-brand-blue">{{ $realisation->kwc }} kWc</span>
                        <span class="inline-flex items-center rounded-full bg-brand-orange/10 px-3 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-brand-orange">{{ ucfirst($realisation->type_bien) }}</span>
                    </div>
                    <p class="text-sm text-slate-500">{{ $realisation->lieu }} @if($realisation->date_realisation) · {{ \Carbon\Carbon::parse($realisation->date_realisation)->translatedFormat('F Y') }} @endif</p>
                    <div class="rounded-3xl bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                        {{ \Illuminate\Support\Str::limit(strip_tags($realisation->description_longue), 110) }}
                    </div>
                </div>
                <div class="border-t border-slate-200/70 bg-slate-50 px-6 py-4">
                    <span class="text-sm font-semibold text-brand-blue">Voir le projet →</span>
                </div>
            </a>
            @empty
            <div class="rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-12 text-center text-slate-500">
                Aucune réalisation ne correspond à ce filtre.
            </div>
            @endforelse
        </div>
    </section>

@endsection