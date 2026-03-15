<x-admin-layout>
    @section('title', 'Fiestas')

    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="font-display text-3xl font-bold text-gray-900">Fiestas</h1>
            <a href="{{ route('admin.fiestas.create') }}" class="btn-primary">+ Nueva fiesta</a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">Nombre</th>
                        <th class="px-6 py-3 text-left">Municipio</th>
                        <th class="px-6 py-3 text-left">Categoría</th>
                        <th class="px-6 py-3 text-left">Fechas</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($festivals as $festival)
                        <tr class="hover:bg-gray-50 {{ $festival->trashed() ? 'opacity-50' : '' }}">
                            <td class="px-6 py-4 font-medium text-gray-900 max-w-xs">
                                {{ $festival->name }}
                                @if($festival->is_featured) <span class="text-amber-DEFAULT">⭐</span> @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $festival->municipality->name ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @if($festival->category)
                                    <span class="badge text-white text-xs" style="background-color: {{ $festival->category->color }}">
                                        {{ $festival->category->name }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                {{ $festival->start_date->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($festival->trashed())
                                    <span class="badge bg-red-100 text-red-600">Eliminada</span>
                                @elseif($festival->is_active)
                                    <span class="badge bg-green-100 text-green-700">Activa</span>
                                @else
                                    <span class="badge bg-gray-100 text-gray-600">Borrador</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if(!$festival->trashed())
                                        <a href="{{ route('admin.fiestas.edit', $festival) }}"
                                           class="text-xs font-medium text-primary-600 hover:underline">Editar</a>
                                        <a href="{{ route('festivals.show', $festival) }}" target="_blank"
                                           class="text-xs font-medium text-gray-400 hover:text-gray-600">Ver</a>
                                        <form action="{{ route('admin.fiestas.destroy', $festival) }}" method="POST"
                                              onsubmit="return confirm('¿Eliminar esta fiesta?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs font-medium text-red-500 hover:underline">Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $festivals->links() }}</div>
    </div>
</x-admin-layout>
