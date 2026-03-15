<x-admin-layout>
    @section('title', 'Nueva fiesta')

    <div class="max-w-3xl">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.fiestas.index') }}" class="text-gray-400 hover:text-gray-600">← Volver</a>
            <h1 class="font-display text-3xl font-bold text-gray-900">Nueva fiesta</h1>
        </div>

        <form action="{{ route('admin.fiestas.store') }}" method="POST" class="space-y-6">
            @csrf
            @include('admin.festivals._form')
            <div class="flex gap-3 pt-4 border-t">
                <button type="submit" class="btn-primary">Crear fiesta</button>
                <a href="{{ route('admin.fiestas.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-admin-layout>
