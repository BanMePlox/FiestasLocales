<x-admin-layout>
    @section('title', 'Categorías')

    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="font-display text-3xl font-bold text-gray-900">Categorías</h1>
            <a href="{{ route('admin.categorias.create') }}" class="btn-primary">+ Nueva categoría</a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">Categoría</th>
                        <th class="px-6 py-3 text-left">Color</th>
                        <th class="px-6 py-3 text-left">Fiestas</th>
                        <th class="px-6 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <span class="badge text-white" style="background-color: {{ $category->color ?? '#ccc' }}">
                                    {{ $category->icon }} {{ $category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full" style="background-color: {{ $category->color ?? '#ccc' }}"></div>
                                    <code class="text-xs text-gray-500">{{ $category->color }}</code>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $category->festivals_count }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.categorias.edit', $category) }}" class="text-xs font-medium text-primary-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.categorias.destroy', $category) }}" method="POST"
                                          onsubmit="return confirm('¿Eliminar categoría?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs font-medium text-red-500 hover:underline">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
