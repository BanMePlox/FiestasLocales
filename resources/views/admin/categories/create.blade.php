<x-admin-layout>
    @section('title', 'Nueva categoría')

    <div class="max-w-lg">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.categorias.index') }}" class="text-gray-400 hover:text-gray-600">← Volver</a>
            <h1 class="font-display text-3xl font-bold text-gray-900">Nueva categoría</h1>
        </div>
        <form action="{{ route('admin.categorias.store') }}" method="POST">
            @csrf
            @include('admin.categories._form')
            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn-primary">Crear categoría</button>
                <a href="{{ route('admin.categorias.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-admin-layout>
