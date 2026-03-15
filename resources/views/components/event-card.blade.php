@props(['event'])

<article class="card group flex flex-col">
    {{-- Image --}}
    <a href="{{ route('events.show', $event) }}" class="block relative overflow-hidden bg-gray-100 aspect-video shrink-0">
        @if($event->cover_image)
            <img src="{{ asset('storage/' . $event->cover_image) }}"
                 alt="{{ $event->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                </svg>
            </div>
        @endif

        {{-- Genre chip --}}
        @if($event->musicGenre)
            <div class="absolute top-3 left-3">
                <span class="badge bg-white/90 text-gray-800 font-medium shadow-sm backdrop-blur-sm">
                    {{ $event->musicGenre->name }}
                </span>
            </div>
        @endif

        {{-- Free badge --}}
        @if($event->isFree())
            <div class="absolute top-3 right-3">
                <span class="badge bg-green-600 text-white font-medium">Entrada libre</span>
            </div>
        @endif
    </a>

    {{-- Content --}}
    <div class="p-4 flex flex-col flex-1">
        {{-- Date & time --}}
        <p class="text-xs text-gray-400 font-medium mb-1 tabular-nums">
            {{ $event->starts_at->translatedFormat('j M Y · H:i') }}
        </p>

        {{-- Title --}}
        <a href="{{ route('events.show', $event) }}">
            <h3 class="font-display font-semibold text-gray-950 leading-snug group-hover:text-accent transition-colors line-clamp-2">
                {{ $event->name }}
            </h3>
        </a>

        {{-- Location --}}
        <p class="text-xs text-gray-400 mt-1.5">
            {{ $event->venue }} · {{ $event->municipality->name }}
        </p>

        {{-- Price + min age --}}
        <div class="flex items-center gap-3 mt-3">
            <span class="text-xs font-semibold {{ $event->isFree() ? 'text-green-600' : 'text-gray-700' }}">
                {{ $event->formattedPrice() }}
            </span>
            @if($event->min_age)
                <span class="text-xs text-gray-400">+{{ $event->min_age }}</span>
            @endif
        </div>
    </div>
</article>
