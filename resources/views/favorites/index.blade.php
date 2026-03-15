<x-app-layout>
    @section('title', 'Mis favoritos')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="font-display text-3xl font-bold text-gray-900 mb-2">❤️ Mis favoritos</h1>
        <p class="text-gray-500 mb-8">{{ $festivals->total() }} fiestas guardadas</p>

        @if($festivals->isEmpty())
            <div class="text-center py-20">
                <p class="text-5xl mb-4">💔</p>
                <h3 class="font-display text-xl font-bold text-gray-700 mb-2">Aún no tienes fiestas favoritas</h3>
                <p class="text-gray-500 mb-6">Explora el catálogo y guarda las fiestas que no te quieres perder.</p>
                <a href="{{ route('festivals.index') }}" class="btn-primary">Explorar fiestas</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($festivals as $festival)
                    <x-festival-card :festival="$festival" />
                @endforeach
            </div>
            <div class="mt-10">{{ $festivals->links() }}</div>
        @endif
    </div>
</x-app-layout>
