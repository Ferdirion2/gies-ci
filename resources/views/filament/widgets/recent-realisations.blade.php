<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach($this->realisations as $realisation)
        @php
            $media = optional($realisation->media->first());
            $url = $media ? (\Illuminate\Support\Facades\Storage::url($media->path)) : null;
        @endphp

        <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm overflow-hidden">
            <div class="w-full h-40 bg-gray-100 flex items-center justify-center">
                @if($url)
                    <img src="{{ $url }}" alt="{{ $realisation->titre }}" class="object-cover w-full h-40" />
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-400">No image</div>
                @endif
            </div>
            <div class="p-3">
                <div class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $realisation->titre }}</div>
                @if($realisation->lieu)
                    <div class="text-xs text-gray-500">{{ $realisation->lieu }}</div>
                @endif
            </div>
        </div>
    @endforeach
</div>
