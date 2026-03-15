<x-admin-layout>
    @section('title', 'Editar: ' . $festival->name)

    <div class="max-w-3xl">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.fiestas.index') }}" class="text-gray-400 hover:text-gray-600">← Volver</a>
            <h1 class="font-display text-3xl font-bold text-gray-900">Editar fiesta</h1>
        </div>

        <form action="{{ route('admin.fiestas.update', $festival) }}" method="POST" class="space-y-6">
            @csrf @method('PUT')
            @include('admin.festivals._form')
            <div class="flex gap-3 pt-4 border-t">
                <button type="submit" class="btn-primary">Guardar cambios</button>
                <a href="{{ route('admin.fiestas.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-admin-layout>
