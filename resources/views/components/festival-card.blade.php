@props(['festival', 'showFavorite' => true])

<article class="card group flex flex-col">
    {{-- Image --}}
    <a href="{{ route('festivals.show', $festival) }}" class="block relative overflow-hidden bg-gray-100 aspect-video shrink-0">
        @if($festival->cover_image)
            <img src="{{ asset('storage/' . $festival->cover_image) }}"
                 alt="{{ $festival->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        {{-- Category chip --}}
        <div class="absolute top-3 left-3">
            <span class="badge bg-white/90 text-gray-800 font-medium shadow-sm backdrop-blur-sm">
                {{ $festival->category->name }}
            </span>
        </div>
    </a>

    {{-- Content --}}
    <div class="p-4 flex flex-col flex-1">
        <div class="flex items-start gap-2">
            <div class="flex-1 min-w-0">
                {{-- Date --}}
                <p class="text-xs text-gray-400 font-medium mb-1 tabular-nums">
                    @if($festival->start_date->isSameDay($festival->end_date))
                        {{ $festival->start_date->translatedFormat('j M Y') }}
                    @else
                        {{ $festival->start_date->translatedFormat('j M') }} – {{ $festival->end_date->translatedFormat('j M Y') }}
                    @endif
                </p>

                {{-- Title --}}
                <a href="{{ route('festivals.show', $festival) }}">
                    <h3 class="font-display font-semibold text-gray-950 leading-snug group-hover:text-accent transition-colors line-clamp-2">
                        {{ $festival->name }}
                    </h3>
                </a>

                {{-- Location --}}
                <p class="text-xs text-gray-400 mt-1.5">
                    {{ $festival->municipality->name }} · {{ $festival->municipality->province->name }}
                </p>
            </div>

            {{-- Favorite --}}
            @if($showFavorite && auth()->check())
                @php $isFav = auth()->user()->hasFavorited($festival); @endphp
                <form action="{{ route('favorites.toggle', $festival) }}" method="POST" class="shrink-0">
                    @csrf
                    <button type="submit"
                            class="p-1.5 rounded-md transition-colors {{ $isFav ? 'text-accent' : 'text-gray-300 hover:text-gray-500' }}"
                            title="{{ $isFav ? 'Quitar de favoritos' : 'Guardar' }}">
                        <svg class="w-4 h-4" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </form>
            @endif
        </div>

        @if($festival->short_description)
            <p class="text-xs text-gray-500 mt-3 line-clamp-2 leading-relaxed flex-1">
                {{ $festival->short_description }}
            </p>
        @endif
    </div>
</article>
