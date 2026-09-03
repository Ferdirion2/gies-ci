@extends('layouts.site')
@section('title', 'Contact')
@section('content')

    <section class="relative isolate overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/pages/contact.jpg') }}"
                alt="Installation solaire"
                class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
        </div>
        <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-24">
            <div class="w-full text-left">
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                    Contact • Parlons de votre projet
                </span>
                <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                    Contactez-nous
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                    {{ $page?->texte_intro ?? "Une question ? Nous vous répondons rapidement." }}
                </p>
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-5xl gap-10 bg-slate-50 px-6 py-16 md:grid-cols-3 md:gap-12 md:py-20">

        <div class="rounded-[2rem] border border-slate-200/80 bg-white p-6 shadow-[0_24px_70px_-42px_rgba(15,23,42,0.3)] sm:p-8 md:col-span-2 lg:p-10">
            @if(session('success'))
            <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm leading-6 text-emerald-800">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('site.contact.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Nom</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">
                    @error('nom') <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">
                    @error('email') <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Sujet</label>
                    <input type="text" name="sujet" value="{{ old('sujet') }}" required
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Message</label>
                    <textarea name="message" rows="5" required class="mt-2 block w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm leading-6 text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/10">{{ old('message') }}</textarea>
                    @error('message') <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>
                <label class="flex items-start gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs leading-5 text-slate-600">
                    <input type="checkbox" name="consentement" required class="mt-0.5 h-4 w-4 rounded border-slate-300 text-brand-blue focus:ring-brand-blue/20">
                    J'accepte que mes données soient utilisées pour traiter ma demande.
                </label>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-full bg-brand-orange px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand-orange/15 transition hover:-translate-y-0.5 hover:bg-orange-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-orange/40 focus-visible:ring-offset-2">
                    Envoyer
                </button>
            </form>
        </div>

        <div class="h-fit space-y-4 rounded-[2rem] border border-slate-200/80 bg-white p-6 text-sm text-slate-600 shadow-[0_24px_70px_-42px_rgba(15,23,42,0.25)] lg:p-7">
            <div class="mb-4 border-b border-slate-100 pb-4 text-base font-bold text-brand-dark">Nos coordonnées</div>
            <p>{{ \App\Models\SiteSetting::where('cle', 'telephone')->value('valeur') ?? '+229 XX XX XX XX' }}</p>
            <p>{{ \App\Models\SiteSetting::where('cle', 'email')->value('valeur') ?? 'contact@gies-ci.com' }}</p>
            <p>{{ \App\Models\SiteSetting::where('cle', 'adresse')->value('valeur') ?? 'Cotonou, Bénin' }}</p>
        </div>
    </section>

@endsection