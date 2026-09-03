@extends('layouts.site')
@section('title', 'Mot de passe oublié')
@section('content')
<section class="mx-auto max-w-md px-6 py-24">
    <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_24px_70px_-42px_rgba(15,23,42,0.3)]">
        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-blue">Espace client</p>
        <h1 class="mt-3 text-3xl font-extrabold text-slate-900">Mot de passe oublié ?</h1>
        <p class="mt-3 text-sm leading-6 text-slate-500">Saisissez votre adresse e-mail pour recevoir un code de vérification.</p>
        @if($errors->any()) <p class="mt-5 rounded-xl bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</p> @endif
        <form method="POST" action="{{ route('client.password.send-code') }}" class="mt-6 space-y-5">
            @csrf
            <div><label for="email" class="mb-2 block text-sm font-medium text-slate-700">Adresse e-mail</label><input id="email" name="email" type="email" required class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-brand-blue/20"></div>
            <button class="w-full rounded-xl bg-orange-500 px-4 py-3 text-sm font-semibold text-white hover:bg-orange-400">Recevoir le code</button>
        </form>
    </div>
</section>
@endsection