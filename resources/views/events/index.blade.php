<x-app-layout>
@section('title', 'Eventos y fiestas con música')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Header --}}
    <div class="mb-8 flex items-end justify-between">
        <div>
            <p class="section-label">Comunitat Valenciana</p>
            <h1 class="text-3xl font-bold text-gray-950 tracking-tight">Eventos</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $events->total() }} {{ $events->total() === 1 ? 'evento' : 'eventos' }} próximos</p>
        </div>
        @auth
            <a href="{{ route('events.create') }}" class="btn-primary text-sm">
                Proponer evento
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-outline text-sm">Proponer evento</a>
        @endauth
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('events.index') }}" class="mb-10">
        <div class="flex flex-col sm:flex-row gap-2 mb-3">
            <div class="flex-1">
                <select name="comarca" class="form-input-fl" onchange="this.form.submit()">
                    <option value="">Todas las comarcas</option>
                    @foreach($comarcas as $comarca)
                        <option value="{{ $comarca->slug }}" {{ request('comarca') === $comarca->slug ? 'selected' : '' }}>
                            {{ $comarca->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <select name="genero" class="form-input-fl" onchange="this.form.submit()">
                    <option value="">Todos los géneros</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->slug }}" {{ request('genero') === $genre->slug ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(request()->hasAny(['comarca','genero','municipio']))
                <a href="{{ route('events.index') }}" class="btn-outline text-sm whitespace-nowrap">Limpiar</a>
            @endif
        </div>
    </form>

    {{-- Grid --}}
    @if($events->isEmpty())
        <div class="text-center py-24">
            <p class="text-4xl font-bold text-gray-200 mb-4">0</p>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Sin eventos próximos</h3>
            <p class="text-sm text-gray-400 mb-6">Prueba con otros filtros o vuelve más tarde.</p>
            <a href="{{ route('events.index') }}" class="btn-outline">Ver todos los eventos</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($events as $event)
                <x-event-card :event="$event" />
            @endforeach
        </div>
        <div class="mt-10">{{ $events->links() }}</div>
    @endif

</div>
</x-app-layout>
