@extends('layouts.site')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Mes demandes</h1>

    @if($devis->isEmpty())
        <p>Aucune demande.</p>
    @else
        <table class="w-full bg-white rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Nom</th>
                    <th class="p-2 text-left">Service</th>
                    <th class="p-2">Statut</th>
                    <th class="p-2">Reçu le</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devis as $d)
                    <tr class="border-t">
                        <td class="p-2">{{ $d->nom }}</td>
                        <td class="p-2">{{ $d->service?->titre ?? '—' }}</td>
                        <td class="p-2 text-center">{{ $d->statut }}</td>
                        <td class="p-2 text-center">{{ $d->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $devis->links() }}</div>
    @endif
</div>
@endsection
