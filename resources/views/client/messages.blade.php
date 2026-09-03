@extends('layouts.site')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Mes messages</h1>

    @if($messages->isEmpty())
        <p>Aucun message.</p>
    @else
        <ul class="space-y-2">
            @foreach($messages as $m)
                <li class="p-3 bg-white rounded shadow">
                    <div class="flex justify-between">
                        <div>
                            <div class="font-semibold">{{ $m->sujet }}</div>
                            <div class="text-sm text-gray-600">{{ Str::limit($m->message, 150) }}</div>
                        </div>
                        <div class="text-sm text-gray-500">{{ $m->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-4">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
