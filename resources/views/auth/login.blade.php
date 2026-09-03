@extends('layouts.site')

@section('content')
<div class="min-h-screen bg-slate-950 px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-6xl overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 shadow-[0_30px_100px_-40px_rgba(2,6,23,0.9)] backdrop-blur-sm lg:grid-cols-[1.1fr_0.9fr]">
        <div class="relative hidden overflow-hidden bg-slate-950 p-10 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(0,158,226,0.25),_transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(249,115,22,0.18),_transparent_30%)]"></div>
            <div class="relative">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="GIES-CI" class="h-12 w-auto" />
                    <div>
                        <div class="text-xs uppercase tracking-[0.28em] text-slate-300">Administration</div>
                        <div class="text-lg font-semibold text-white">GIES-CI</div>
                    </div>
                </div>

                <div class="mt-14 max-w-md">
                    <p class="text-xs uppercase tracking-[0.32em] text-orange-300">Accès sécurisé</p>
                    <h1 class="mt-4 text-4xl font-extrabold leading-tight">Espace d’administration</h1>
                    <p class="mt-5 text-base leading-7 text-slate-300">
                        Gérez les services, réalisations, ressources et demandes clients depuis un espace centralisé et sécurisé.
                    </p>
                </div>
            </div>

            <div class="relative mt-10 rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                <p class="text-xs uppercase tracking-[0.22em] text-slate-300">Branding</p>
                <p class="mt-3 text-sm leading-6 text-slate-200">
                    Solution solaire • Installation • Maintenance • Expertise technique
                </p>
            </div>
        </div>

        <div class="bg-white px-5 py-8 sm:px-8 lg:px-10 lg:py-12">
            <div class="mx-auto max-w-md">
                <div class="mb-8 text-center lg:text-left">
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-blue">Connexion</p>
                    <h2 class="mt-3 text-3xl font-extrabold text-slate-900">Bienvenue</h2>
                    <p class="mt-2 text-sm text-slate-500">Connectez-vous pour accéder au tableau de bord.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Adresse e-mail</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-brand-blue/20" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Mot de passe</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-brand-blue/20" />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-slate-600">
                            <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-brand-blue focus:ring-brand-blue">
                            Se souvenir de moi
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-brand-blue hover:text-brand-orange">Mot de passe oublié ?</a>
                        @endif
                    </div>

                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-xl bg-orange-500 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-300">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
