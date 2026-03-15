<x-admin-layout>
    @section('title', 'Municipios')

    <div>
        <h1 class="font-display text-3xl font-bold text-gray-900 mb-6">Municipios</h1>

        <form method="GET" class="mb-6 flex flex-wrap gap-3 items-center">
            <select name="province_id" class="form-input-fl max-w-xs py-2" onchange="this.form.submit()">
                <option value="">Todas las provincias</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>
                        {{ $province->name }}
                    </option>
                @endforeach
            </select>

            <select name="comarca_id" class="form-input-fl max-w-xs py-2" onchange="this.form.submit()">
                <option value="">Todas las comarcas</option>
                @foreach($comarcas as $comarca)
                    <option value="{{ $comarca->id }}" {{ request('comarca_id') == $comarca->id ? 'selected' : '' }}>
                        {{ $comarca->name }}
                    </option>
                @endforeach
            </select>

            @if(request()->hasAny(['province_id', 'comarca_id']))
                <a href="{{ route('admin.municipios.index') }}" class="text-xs text-gray-400 hover:text-gray-700">
                    Limpiar filtros
                </a>
            @endif
        </form>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">Municipio</th>
                        <th class="px-6 py-3 text-left">Provincia</th>
                        <th class="px-6 py-3 text-left hidden lg:table-cell">Comarca</th>
                        <th class="px-6 py-3 text-left hidden md:table-cell">Población</th>
                        <th class="px-6 py-3 text-left">Fiestas</th>
                        <th class="px-6 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($municipalities as $municipality)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 font-medium text-gray-900">{{ $municipality->name }}</td>
                            <td class="px-6 py-3 text-gray-500">{{ $municipality->province->name }}</td>
                            <td class="px-6 py-3 hidden lg:table-cell">
                                @if($municipality->comarca)
                                    <a href="{{ route('comarcas.show', $municipality->comarca) }}"
                                       class="text-xs text-gray-600 hover:text-gray-950 hover:underline">
                                        {{ $municipality->comarca->name }}
                                    </a>
                                @else
                                    <span class="text-xs text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-gray-500 hidden md:table-cell">{{ $municipality->population ? number_format($municipality->population) : '—' }}</td>
                            <td class="px-6 py-3 text-gray-500">{{ $municipality->festivals_count }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('admin.municipios.edit', $municipality) }}" class="text-xs font-medium text-primary-600 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $municipalities->links() }}</div>
    </div>
</x-admin-layout>
