@php use Illuminate\Support\Str; @endphp

<x-app-layout>
@section('title', $festival->name)
@section('description', $festival->short_description ?? Str::limit($festival->description, 160))
@if($festival->cover_image)@section('og_image', asset('storage/' . $festival->cover_image))@endif

{{-- Hero image --}}
<div class="relative h-56 md:h-80 bg-gray-100 overflow-hidden">
    @if($festival->cover_image)
        <img src="{{ asset('storage/' . $festival->cover_image) }}"
             alt="{{ $festival->name }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
    @else
        <div class="w-full h-full bg-gray-950 flex items-center justify-center">
            <p class="text-gray-700 text-sm">Sin imagen</p>
        </div>
    @endif
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1.5 text-xs text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors">Inicio</a>
        <span>/</span>
        <a href="{{ route('festivals.index') }}" class="hover:text-gray-700 transition-colors">Fiestas</a>
        <span>/</span>
        <span class="text-gray-600">{{ $festival->name }}</span>
    </nav>

    <div class="lg:grid lg:grid-cols-3 lg:gap-16">

        {{-- Main --}}
        <div class="lg:col-span-2">

            {{-- Category + title --}}
            <p class="section-label">{{ $festival->category->name }}</p>
            <h1 class="font-display text-3xl md:text-4xl font-bold text-gray-950 leading-snug mb-2">
                {{ $festival->name }}
            </h1>
            <p class="text-sm text-gray-400 mb-8">
                {{ $festival->municipality->name }}, {{ $festival->municipality->province->name }}
            </p>

            {{-- Description --}}
            <div class="text-gray-600 leading-relaxed whitespace-pre-line">
                {{ $festival->description }}
            </div>

            {{-- Gallery --}}
            @if($festival->images->isNotEmpty())
                <div class="mt-12">
                    <p class="section-label mb-4">Galería</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach($festival->images as $image)
                            <div class="aspect-video rounded-md overflow-hidden bg-gray-100">
                                <img src="{{ $image->url }}" alt="{{ $image->caption }}"
                                     class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Map --}}
            @if($festival->lat && $festival->lng)
                <div class="mt-12">
                    <p class="section-label mb-4">Ubicación</p>
                    <div class="rounded-md overflow-hidden border border-gray-200 aspect-video">
                        <iframe
                            src="https://www.openstreetmap.org/export/embed.html?bbox={{ $festival->lng - 0.02 }},{{ $festival->lat - 0.01 }},{{ $festival->lng + 0.02 }},{{ $festival->lat + 0.01 }}&layer=mapnik&marker={{ $festival->lat }},{{ $festival->lng }}"
                            class="w-full h-full border-0" loading="lazy">
                        </iframe>
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="mt-10 lg:mt-0">
            <div class="border border-gray-200 rounded-lg p-6 sticky top-20 space-y-6">

                {{-- Dates --}}
                <div>
                    <p class="section-label">Fechas</p>
                    <p class="text-base font-semibold text-gray-900">
                        @if($festival->start_date->isSameDay($festival->end_date))
                            {{ $festival->start_date->translatedFormat('j \d\e F \d\e Y') }}
                        @else
                            {{ $festival->start_date->translatedFormat('j \d\e F') }}
                            al {{ $festival->end_date->translatedFormat('j \d\e F \d\e Y') }}
                        @endif
                    </p>
                </div>

                {{-- Address --}}
                @if($festival->address)
                    <div>
                        <p class="section-label">Dirección</p>
                        <p class="text-sm text-gray-600">{{ $festival->address }}</p>
                    </div>
                @endif

                {{-- Website --}}
                @if($festival->website_url)
                    <a href="{{ $festival->website_url }}" target="_blank" rel="noopener noreferrer"
                       class="btn-outline w-full text-sm">
                        Sitio web oficial
                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                @endif

                {{-- Favorite --}}
                @auth
                    <form action="{{ route('favorites.toggle', $festival) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full {{ $isFavorited ? 'btn-accent' : 'btn-outline' }} text-sm gap-2">
                            <svg class="w-4 h-4" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            {{ $isFavorited ? 'Guardado en favoritos' : 'Guardar en favoritos' }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-outline w-full text-sm gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Inicia sesión para guardar
                    </a>
                @endauth

                {{-- Views --}}
                <p class="text-xs text-gray-400 text-center pt-2 border-t border-gray-100">
                    {{ number_format($festival->views_count) }} visualizaciones
                </p>
            </div>
        </div>

    </div>

    {{-- Related --}}
    @if($related->isNotEmpty())
        <div class="mt-20">
            <div class="mb-6">
                <p class="section-label">Más fiestas</p>
                <h2 class="text-xl font-bold text-gray-950 tracking-tight">También puede interesarte</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                @foreach($related as $relatedFestival)
                    <x-festival-card :festival="$relatedFestival" />
                @endforeach
            </div>
        </div>
    @endif

</div>

</x-app-layout>
