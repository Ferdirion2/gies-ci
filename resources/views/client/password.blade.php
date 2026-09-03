@extends('layouts.site')
@section('title', 'Changer mon mot de passe')
@section('content')

    <section class="max-w-md mx-auto px-6 py-24">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Changer mon mot de passe</h1>

        @if($errors->any())
        <div class="bg-red-50 text-red-600 text-sm rounded-lg px-4 py-3 mb-6">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('client.password.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm font-medium text-gray-700">Mot de passe actuel</label>
                <input type="password" name="mot_de_passe_actuel" required
                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-brand-blue focus:ring-brand-blue">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                <input type="password" name="nouveau_mot_de_passe" required
                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-brand-blue focus:ring-brand-blue">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                <input type="password" name="nouveau_mot_de_passe_confirmation" required
                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-brand-blue focus:ring-brand-blue">
            </div>

            <button type="submit" class="w-full bg-brand-orange text-white font-semibold py-3 rounded-lg hover:bg-orange-600 transition-colors">
                Mettre à jour
            </button>
        </form>

        <a href="{{ route('client.dashboard') }}" class="block text-center text-sm text-gray-500 mt-6 hover:text-gray-900">
            ← Retour à mon espace
        </a>
    </section>

@endsection