<x-app-layout>
@section('title', 'Explorar fiestas')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Header --}}
    <div class="mb-8">
        <p class="section-label">Comunitat Valenciana</p>
        <h1 class="text-3xl font-bold text-gray-950 tracking-tight">Fiestas</h1>
        <p class="text-sm text-gray-400 mt-1">{{ $festivals->total() }} {{ $festivals->total() === 1 ? 'fiesta' : 'fiestas' }}</p>
    </div>

    {{-- Filters --}}
    <div x-data="{ open: false }" class="mb-10">
        <form method="GET" action="{{ route('festivals.index') }}">

            {{-- Active filter chips --}}
            @php $hasFilters = request()->hasAny(['provincia','categoria','desde','hasta','q']); @endphp
            @if($hasFilters)
                <div class="flex flex-wrap gap-1.5 mb-4">
                    @if(request('provincia'))
                        <span class="badge border border-gray-300 bg-white text-gray-700">
                            {{ ucfirst(request('provincia')) }}
                            <a href="{{ route('festivals.index', array_filter(array_merge(request()->except('provincia','page')))) }}"
                               class="ml-1 text-gray-400 hover:text-gray-700">×</a>
                        </span>
                    @endif
                    @if(request('categoria'))
                        <span class="badge border border-gray-300 bg-white text-gray-700">
                            {{ ucfirst(str_replace('-',' ', request('categoria'))) }}
                            <a href="{{ route('festivals.index', array_filter(array_merge(request()->except('categoria','page')))) }}"
                               class="ml-1 text-gray-400 hover:text-gray-700">×</a>
                        </span>
                    @endif
                    @if(request('q'))
                        <span class="badge border border-gray-300 bg-white text-gray-700">
                            "{{ request('q') }}"
                            <a href="{{ route('festivals.index', array_filter(array_merge(request()->except('q','page')))) }}"
                               class="ml-1 text-gray-400 hover:text-gray-700">×</a>
                        </span>
                    @endif
                    @if(request('desde') || request('hasta'))
                        <span class="badge border border-gray-300 bg-white text-gray-700">
                            {{ request('desde','…') }} → {{ request('hasta','…') }}
                            <a href="{{ route('festivals.index', array_filter(array_merge(request()->except('desde','hasta','page')))) }}"
                               class="ml-1 text-gray-400 hover:text-gray-700">×</a>
                        </span>
                    @endif
                    <a href="{{ route('festivals.index') }}" class="badge border border-gray-200 bg-white text-gray-400 hover:text-gray-700 transition-colors">
                        Limpiar todo
                    </a>
                </div>
            @endif

            {{-- Search + filter toggle --}}
            <div class="flex flex-col sm:flex-row gap-2">
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="Buscar por nombre..."
                           class="form-input-fl pl-9 h-10">
                </div>
                <button type="button" @click="open = !open"
                        class="btn-outline h-10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4h18M7 12h10M11 20h2"/>
                    </svg>
                    Filtros
                </button>
                <button type="submit" class="btn-primary h-10">Buscar</button>
            </div>

            {{-- Collapsible panel --}}
            <div x-show="open" x-transition class="mt-3 border border-gray-200 rounded-md bg-white p-5 grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="section-label block">Provincia</label>
                    <select name="provincia" class="form-input-fl" onchange="this.form.submit()">
                        <option value="">Todas</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->slug }}" {{ request('provincia') === $province->slug ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="section-label block">Categoría</label>
                    <select name="categoria" class="form-input-fl" onchange="this.form.submit()">
                        <option value="">Todas</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('categoria') === $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="section-label block">Desde</label>
                    <input type="date" name="desde" value="{{ request('desde') }}" class="form-input-fl" onchange="this.form.submit()">
                </div>
                <div>
                    <label class="section-label block">Hasta</label>
                    <input type="date" name="hasta" value="{{ request('hasta') }}" class="form-input-fl" onchange="this.form.submit()">
                </div>
            </div>
        </form>
    </div>

    {{-- Grid --}}
    @if($festivals->isEmpty())
        <div class="text-center py-24">
            <p class="text-4xl font-bold text-gray-200 mb-4">0</p>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Sin resultados</h3>
            <p class="text-sm text-gray-400 mb-6">Prueba con otros filtros.</p>
            <a href="{{ route('festivals.index') }}" class="btn-outline">Ver todas las fiestas</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($festivals as $festival)
                <x-festival-card :festival="$festival" />
            @endforeach
        </div>
        <div class="mt-10">{{ $festivals->links() }}</div>
    @endif

</div>
</x-app-layout>
