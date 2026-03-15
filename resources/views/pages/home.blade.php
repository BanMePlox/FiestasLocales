<x-app-layout>
@section('title', 'Fiestas locales de la Comunitat Valenciana')

{{-- HERO --}}
<section class="bg-gray-950 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 md:py-40">
        <p class="section-label text-gray-500 mb-6">Comunitat Valenciana</p>
        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight tracking-tight max-w-3xl mb-6">
            El calendario de fiestas que mereces conocer.
        </h1>
        <p class="text-gray-400 text-lg max-w-xl mb-10 leading-relaxed">
            Fallas, Moros y Cristianos, Semana Santa, Hogueras de San Juan. Todo el patrimonio festivo de la Comunitat en un solo lugar.
        </p>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('festivals.index') }}"
               class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-gray-950 text-sm font-semibold rounded-md hover:bg-gray-100 transition-colors">
                Explorar fiestas
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @guest
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-700 text-gray-300 text-sm font-medium rounded-md hover:border-gray-500 hover:text-white transition-colors">
                    Crear cuenta
                </a>
            @endguest
        </div>
    </div>
</section>

{{-- PROVINCIAS --}}
<section class="border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-3 divide-x divide-gray-100">
            @foreach($provinces as $province)
                <a href="{{ route('festivals.index', ['provincia' => $province->slug]) }}"
                   class="group flex flex-col items-center py-6 px-4 hover:bg-gray-50 transition-colors text-center">
                    <span class="text-lg font-semibold text-gray-900 group-hover:text-accent transition-colors">
                        {{ $province->name }}
                    </span>
                    <span class="text-xs text-gray-400 mt-1">{{ $province->municipalities_count }} municipios</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- FIESTAS DESTACADAS --}}
@if($featuredFestivals->isNotEmpty())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-baseline justify-between mb-8">
            <div>
                <p class="section-label">Selección</p>
                <h2 class="text-2xl font-bold text-gray-950 tracking-tight">Fiestas destacadas</h2>
            </div>
            <a href="{{ route('festivals.index') }}"
               class="text-sm text-gray-500 hover:text-gray-950 transition-colors">
                Ver todas
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($featuredFestivals as $festival)
                <x-festival-card :festival="$festival" />
            @endforeach
        </div>
    </section>
@endif

{{-- PRÓXIMAS --}}
@if($upcomingFestivals->isNotEmpty())
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between mb-8">
                <div>
                    <p class="section-label">Próximamente</p>
                    <h2 class="text-2xl font-bold text-gray-950 tracking-tight">Calendario</h2>
                </div>
                <a href="{{ route('festivals.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-950 transition-colors">
                    Ver calendario completo
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($upcomingFestivals->take(8) as $festival)
                    <x-festival-card :festival="$festival" />
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- CATEGORÍAS --}}
@if($categories->isNotEmpty())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8">
            <p class="section-label">Explorar por tipo</p>
            <h2 class="text-2xl font-bold text-gray-950 tracking-tight">Tipos de fiestas</h2>
        </div>
        <div class="flex flex-wrap gap-2">
            @foreach($categories as $category)
                <a href="{{ route('festivals.index', ['categoria' => $category->slug]) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-medium border border-gray-200 text-gray-700 hover:border-gray-400 hover:text-gray-950 transition-colors bg-white">
                    {{ $category->name }}
                    <span class="text-gray-400 text-xs">{{ $category->festivals_count }}</span>
                </a>
            @endforeach
        </div>
    </section>
@endif

{{-- CTA --}}
@guest
    <section class="bg-gray-950 py-20">
        <div class="max-w-2xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white tracking-tight mb-4">
                No te pierdas ninguna fiesta.
            </h2>
            <p class="text-gray-400 mb-8">
                Crea tu cuenta y guarda en favoritos las celebraciones que no quieres perderte.
            </p>
            <a href="{{ route('register') }}"
               class="inline-flex items-center px-6 py-3 bg-white text-gray-950 text-sm font-semibold rounded-md hover:bg-gray-100 transition-colors">
                Crear cuenta gratis
            </a>
        </div>
    </section>
@endguest

</x-app-layout>
