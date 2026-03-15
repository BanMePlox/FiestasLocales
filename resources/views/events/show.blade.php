@php use Illuminate\Support\Str; @endphp

<x-app-layout>
@section('title', $event->name)
@section('description', $event->description ? Str::limit($event->description, 160) : $event->name . ' — ' . $event->venue . ', ' . $event->municipality->name)
@if($event->cover_image)@section('og_image', asset('storage/' . $event->cover_image))@endif

{{-- Hero image --}}
<div class="relative h-56 md:h-80 bg-gray-100 overflow-hidden">
    @if($event->cover_image)
        <img src="{{ asset('storage/' . $event->cover_image) }}"
             alt="{{ $event->name }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
    @else
        <div class="w-full h-full bg-gray-950 flex items-center justify-center">
            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
            </svg>
        </div>
    @endif
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1.5 text-xs text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors">Inicio</a>
        <span>/</span>
        <a href="{{ route('events.index') }}" class="hover:text-gray-700 transition-colors">Eventos</a>
        @if($event->municipality->comarca)
            <span>/</span>
            <a href="{{ route('comarcas.show', $event->municipality->comarca) }}" class="hover:text-gray-700 transition-colors">
                {{ $event->municipality->comarca->name }}
            </a>
        @endif
        <span>/</span>
        <span class="text-gray-600">{{ $event->name }}</span>
    </nav>

    <div class="lg:grid lg:grid-cols-3 lg:gap-16">

        {{-- Main --}}
        <div class="lg:col-span-2">

            @if($event->musicGenre)
                <p class="section-label">{{ $event->musicGenre->name }}</p>
            @endif
            <h1 class="font-display text-3xl md:text-4xl font-bold text-gray-950 leading-snug mb-2">
                {{ $event->name }}
            </h1>
            <p class="text-sm text-gray-400 mb-8">
                {{ $event->venue }} · {{ $event->municipality->name }}
                @if($event->municipality->comarca)
                    · {{ $event->municipality->comarca->name }}
                @endif
            </p>

            @if($event->description)
                <div class="text-gray-600 leading-relaxed whitespace-pre-line">
                    {{ $event->description }}
                </div>
            @endif

            {{-- Map --}}
            @if($event->lat && $event->lng)
                <div class="mt-12">
                    <p class="section-label mb-4">Ubicación</p>
                    <div class="rounded-md overflow-hidden border border-gray-200 aspect-video">
                        <iframe
                            src="https://www.openstreetmap.org/export/embed.html?bbox={{ $event->lng - 0.01 }},{{ $event->lat - 0.008 }},{{ $event->lng + 0.01 }},{{ $event->lat + 0.008 }}&layer=mapnik&marker={{ $event->lat }},{{ $event->lng }}"
                            class="w-full h-full border-0" loading="lazy">
                        </iframe>
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="mt-10 lg:mt-0">
            <div class="border border-gray-200 rounded-lg p-6 sticky top-20 space-y-6">

                {{-- Date & time --}}
                <div>
                    <p class="section-label">Cuándo</p>
                    <p class="text-base font-semibold text-gray-900">
                        {{ $event->starts_at->translatedFormat('j \d\e F \d\e Y') }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $event->starts_at->format('H:i') }}
                        @if($event->ends_at)
                            – {{ $event->ends_at->format('H:i') }}
                        @endif
                    </p>
                </div>

                {{-- Venue --}}
                <div>
                    <p class="section-label">Dónde</p>
                    <p class="text-sm font-medium text-gray-900">{{ $event->venue }}</p>
                    @if($event->address)
                        <p class="text-xs text-gray-500 mt-0.5">{{ $event->address }}</p>
                    @endif
                    <p class="text-xs text-gray-400 mt-1">{{ $event->municipality->name }}</p>
                </div>

                {{-- Price --}}
                <div>
                    <p class="section-label">Precio</p>
                    <p class="text-base font-semibold {{ $event->isFree() ? 'text-green-600' : 'text-gray-900' }}">
                        {{ $event->formattedPrice() }}
                    </p>
                    @if($event->min_age)
                        <p class="text-xs text-gray-400 mt-1">Acceso a partir de {{ $event->min_age }} años</p>
                    @endif
                </div>

                {{-- Genre --}}
                @if($event->musicGenre)
                    <div>
                        <p class="section-label">Música</p>
                        <span class="badge border border-gray-200 text-gray-700">{{ $event->musicGenre->name }}</span>
                    </div>
                @endif

                {{-- Links --}}
                @if($event->website_url)
                    <a href="{{ $event->website_url }}" target="_blank" rel="noopener noreferrer"
                       class="btn-outline w-full text-sm">
                        Sitio web oficial
                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                @endif

                @if($event->instagram_url)
                    <a href="{{ $event->instagram_url }}" target="_blank" rel="noopener noreferrer"
                       class="btn-ghost w-full text-sm">
                        Instagram
                    </a>
                @endif
            </div>
        </div>

    </div>

    {{-- Related --}}
    @if($related->isNotEmpty())
        <div class="mt-20">
            <div class="mb-6">
                <p class="section-label">Más eventos</p>
                <h2 class="text-xl font-bold text-gray-950 tracking-tight">También puede interesarte</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                @foreach($related as $rel)
                    <x-event-card :event="$rel" />
                @endforeach
            </div>
        </div>
    @endif

</div>

</x-app-layout>
