<x-admin-layout>
    @section('title', $festival->name)

    <div>
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.fiestas.index') }}" class="text-gray-400 hover:text-gray-600">← Volver</a>
            <h1 class="font-display text-3xl font-bold text-gray-900">{{ $festival->name }}</h1>
        </div>
        <a href="{{ route('admin.fiestas.edit', $festival) }}" class="btn-primary">Editar</a>
    </div>
</x-admin-layout>
