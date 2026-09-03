@extends('layouts.site')
@section('title', 'Demande de devis')
@section('content')

    <section class="relative isolate overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/pages/devis.jpg') }}"
                alt="Installation solaire"
                class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
        </div>
        <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-24">
            <div class="w-full text-left">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    Devis • Obtenez une estimation rapide
                </span>
                <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                    Demandez votre devis gratuit
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                    {{ $page?->texte_intro ?? "Réponse sous 48h ouvrées." }}
                </p>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 px-6 py-16 sm:py-20">
        <div class="mx-auto max-w-2xl rounded-[2rem] border border-slate-200/80 bg-white p-6 shadow-[0_24px_70px_-42px_rgba(15,23,42,0.3)] sm:p-8 lg:p-10">

        @if(session('success'))
        <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm leading-6 text-emerald-800">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('site.devis.store') }}" class="space-y-6">
            @csrf

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Nom</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">
                    @error('nom') <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}"
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email" value="{{ auth('client')->check() ? auth('client')->user()->email : old('email') }}" required
                    @disabled(auth('client')->check())
                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500">
                @error('email') <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Service concerné</label>
                    <select name="service_id" class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">
                        <option value="">— Sélectionner —</option>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}" @selected(request('service') == $s->id)>{{ $s->titre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Type de bien</label>
                    <select name="type_bien" required class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">
                        <option value="maison">Maison individuelle</option>
                        <option value="entreprise">Entreprise</option>
                        <option value="collectivite">Collectivité</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Message</label>
                <textarea name="message" rows="4" class="mt-2 block w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm leading-6 text-slate-900 shadow-sm outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">{{ old('message') }}</textarea>
            </div>

            <label class="flex items-start gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs leading-5 text-slate-600">
                <input type="checkbox" name="consentement" required class="mt-0.5 h-4 w-4 rounded border-slate-300 text-brand-blue focus:ring-brand-blue/20">
                J'accepte que mes données soient utilisées pour traiter ma demande.
            </label>
            @error('consentement') <p class="text-xs text-red-500">{{ $message }}</p> @enderror

            <button type="submit"
                class="w-full rounded-full bg-brand-orange py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand-orange/15 transition hover:-translate-y-0.5 hover:bg-orange-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-orange/40 focus-visible:ring-offset-2">
                Envoyer ma demande
            </button>
        </form>
        </div>
    </section>

@endsection