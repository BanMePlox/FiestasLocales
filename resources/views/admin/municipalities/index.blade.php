<x-admin-layout>
    @section('title', 'Municipios')

    <div>
        <h1 class="font-display text-3xl font-bold text-gray-900 mb-6">Municipios</h1>

        <form method="GET" class="mb-6 flex gap-3">
            <select name="province_id" class="form-input-fl max-w-xs py-2" onchange="this.form.submit()">
                <option value="">Todas las provincias</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>
                        {{ $province->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">Municipio</th>
                        <th class="px-6 py-3 text-left">Provincia</th>
                        <th class="px-6 py-3 text-left">Población</th>
                        <th class="px-6 py-3 text-left">Fiestas</th>
                        <th class="px-6 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($municipalities as $municipality)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 font-medium text-gray-900">{{ $municipality->name }}</td>
                            <td class="px-6 py-3 text-gray-500">{{ $municipality->province->name }}</td>
                            <td class="px-6 py-3 text-gray-500">{{ $municipality->population ? number_format($municipality->population) : '—' }}</td>
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
