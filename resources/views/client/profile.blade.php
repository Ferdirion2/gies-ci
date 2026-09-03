@extends('layouts.site')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Mon profil</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('client.profile.update') }}" class="mb-6 bg-white p-4 rounded shadow">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $client->nom) }}" class="w-full border p-2 rounded" required>
            @error('nom') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $client->email) }}" class="w-full border p-2 rounded" required>
            @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="text-right">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Modifier mes informations</button>
        </div>
    </form>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold mb-3">Changer mon mot de passe</h2>

        <form method="POST" action="{{ route('client.profile.password.update') }}">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Mot de passe actuel</label>
                <input type="password" name="current_password" class="w-full border p-2 rounded" required>
                @error('current_password') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Nouveau mot de passe</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
                @error('password') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Confirmer le nouveau mot de passe</label>
                <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
            </div>

            <div class="text-right">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Modifier mon mot de passe</button>
            </div>
        </form>
    </div>
</div>
@endsection
