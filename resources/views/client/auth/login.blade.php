@extends('layouts.site')

@section('content')
<div class="min-h-screen bg-slate-950 px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-6xl overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 shadow-[0_30px_100px_-40px_rgba(2,6,23,0.9)] backdrop-blur-sm lg:grid-cols-[1.15fr_0.85fr]">
        <div class="relative hidden overflow-hidden bg-slate-950 p-10 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(0,158,226,0.22),_transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(249,115,22,0.18),_transparent_30%)]"></div>
            <div class="relative">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="GIES-CI" class="h-12 w-auto" />
                    <div>
                        <div class="text-xs uppercase tracking-[0.28em] text-slate-300">Espace client</div>
                        <div class="text-lg font-semibold text-white">GIES-CI</div>
                    </div>
                </div>

                <div class="mt-14 max-w-md">
                    <p class="text-xs uppercase tracking-[0.32em] text-orange-300">Suivi de vos projets</p>
                    <h1 class="mt-4 text-4xl font-extrabold leading-tight">Accédez à votre espace personnalisé</h1>
                    <p class="mt-5 text-base leading-7 text-slate-300">
                        Consultez vos demandes, suivez vos projets solaires et accédez aux informations utiles à votre installation.
                    </p>
                </div>
            </div>

            <div class="relative mt-10 rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                <p class="text-xs uppercase tracking-[0.22em] text-slate-300">Votre compte</p>
                <p class="mt-3 text-sm leading-6 text-slate-200">
                    Un compte client est créé automatiquement lors de votre première demande de devis.
                </p>
            </div>
        </div>

        <div class="bg-white px-5 py-8 sm:px-8 lg:px-10 lg:py-12">
            <div class="mx-auto max-w-md">
                <div class="mb-8 text-center lg:text-left">
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-blue">Connexion</p>
                    <h2 class="mt-3 text-3xl font-extrabold text-slate-900">Espace client</h2>
                    <p class="mt-2 text-sm text-slate-500">Identifiez-vous pour continuer.</p>
                </div>

                @if(session('status'))
                    <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('client.login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Adresse e-mail</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-brand-blue/20" />
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Mot de passe</label>
                        <input id="password" name="password" type="password" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-brand-blue/20" />
                    </div>

                    <div class="text-right">
                        <a href="{{ route('client.password.forgot') }}" class="text-sm font-medium text-brand-blue transition hover:text-brand-orange">Mot de passe oublié ?</a>
                    </div>

                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-xl bg-orange-500 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-300">
                        Se connecter
                    </button>
                </form>

                <p class="mt-6 text-sm leading-6 text-slate-600">
                    Remarque : un compte client est créé automatiquement lors de votre première demande de devis. Utilisez l’email correspondant pour vous connecter.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection