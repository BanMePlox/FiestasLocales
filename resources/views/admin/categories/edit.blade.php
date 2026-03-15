<x-admin-layout>
    @section('title', 'Editar: ' . $category->name)

    <div class="max-w-lg">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.categorias.index') }}" class="text-gray-400 hover:text-gray-600">← Volver</a>
            <h1 class="font-display text-3xl font-bold text-gray-900">Editar categoría</h1>
        </div>
        <form action="{{ route('admin.categorias.update', $category) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.categories._form')
            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn-primary">Guardar cambios</button>
                <a href="{{ route('admin.categorias.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-admin-layout>
