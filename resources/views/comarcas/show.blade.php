<x-app-layout>
@section('title', $comarca->name . ' — Eventos y fiestas')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1.5 text-xs text-gray-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors">Inicio</a>
        <span>/</span>
        <a href="{{ route('events.index') }}" class="hover:text-gray-700 transition-colors">Eventos</a>
        <span>/</span>
        <span class="text-gray-600">{{ $comarca->name }}</span>
    </nav>

    {{-- Header --}}
    <div class="mb-10 flex items-end justify-between">
        <div>
            <p class="section-label">{{ $comarca->province->name }}</p>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-950 tracking-tight">{{ $comarca->name }}</h1>
            @if($comarca->description)
                <p class="text-sm text-gray-500 mt-2 max-w-xl">{{ $comarca->description }}</p>
            @endif
        </div>
        @auth
            <a href="{{ route('events.create') }}" class="btn-primary text-sm hidden sm:inline-flex">
                Proponer evento
            </a>
        @endauth
    </div>

    {{-- Municipalities --}}
    <section class="mb-12">
        <p class="section-label mb-3">Municipios</p>
        <div class="flex flex-wrap gap-1.5">
            @foreach($comarca->municipalities->sortBy('name') as $municipality)
                <a href="{{ route('events.index', ['municipio' => $municipality->slug]) }}"
                   class="badge border border-gray-200 bg-white text-gray-700 hover:border-gray-400 hover:text-gray-950 transition-colors">
                    {{ $municipality->name }}
                </a>
            @endforeach
        </div>
    </section>

    {{-- Upcoming events --}}
    <section>
        <div class="mb-6 flex items-baseline justify-between">
            <div>
                <p class="section-label">Próximamente</p>
                <h2 class="text-xl font-bold text-gray-950 tracking-tight">Eventos en {{ $comarca->name }}</h2>
            </div>
            @auth
                <a href="{{ route('events.create') }}" class="btn-primary text-sm sm:hidden">Proponer</a>
            @endauth
        </div>

        @if($events->isEmpty())
            <div class="text-center py-16 border border-dashed border-gray-200 rounded-lg">
                <p class="text-gray-400 text-sm mb-4">No hay eventos próximos en esta comarca.</p>
                @auth
                    <a href="{{ route('events.create') }}" class="btn-outline text-sm">Sé el primero en proponer uno</a>
                @else
                    <a href="{{ route('login') }}" class="btn-outline text-sm">Inicia sesión para proponer un evento</a>
                @endauth
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($events as $event)
                    <x-event-card :event="$event" />
                @endforeach
            </div>
            @if($events->hasPages())
                <div class="mt-8">{{ $events->links() }}</div>
            @endif
        @endif
    </section>

    {{-- Past events --}}
    @if($pastEvents->isNotEmpty())
        <section class="mt-16">
            <div class="mb-6">
                <p class="section-label">Historial</p>
                <h2 class="text-xl font-bold text-gray-950 tracking-tight">Eventos pasados</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 opacity-60">
                @foreach($pastEvents as $event)
                    <x-event-card :event="$event" />
                @endforeach
            </div>
        </section>
    @endif

</div>
</x-app-layout>
