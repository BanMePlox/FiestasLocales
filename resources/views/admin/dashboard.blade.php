<x-admin-layout>
    @section('title', 'Dashboard')

    <div>
        <h1 class="font-display text-3xl font-bold text-gray-900 mb-8">Dashboard</h1>

        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-10">
            @foreach([
                ['label' => 'Fiestas totales', 'value' => $stats['festivals'], 'icon' => '🎉'],
                ['label' => 'Fiestas activas', 'value' => $stats['active'], 'icon' => '✅'],
                ['label' => 'Municipios', 'value' => $stats['municipalities'], 'icon' => '📍'],
                ['label' => 'Categorías', 'value' => $stats['categories'], 'icon' => '🏷️'],
                ['label' => 'Usuarios', 'value' => $stats['users'], 'icon' => '👤'],
            ] as $stat)
                <div class="bg-white rounded-2xl border border-gray-200 p-5 text-center">
                    <div class="text-3xl mb-2">{{ $stat['icon'] }}</div>
                    <div class="font-display font-bold text-2xl text-gray-900">{{ $stat['value'] }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>

        {{-- Quick actions --}}
        <div class="flex gap-3 mb-10">
            <a href="{{ route('admin.fiestas.create') }}" class="btn-primary">+ Nueva fiesta</a>
            <a href="{{ route('admin.categorias.create') }}" class="btn-secondary">+ Nueva categoría</a>
        </div>

        {{-- Recent festivals --}}
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">Últimas fiestas añadidas</h2>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">Nombre</th>
                        <th class="px-6 py-3 text-left">Municipio</th>
                        <th class="px-6 py-3 text-left">Categoría</th>
                        <th class="px-6 py-3 text-left">Fechas</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($latestFestivals as $festival)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <a href="{{ route('admin.fiestas.edit', $festival) }}" class="hover:text-primary-600">
                                    {{ $festival->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $festival->municipality->name ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="badge text-white text-xs" style="background-color: {{ $festival->category->color ?? '#ccc' }}">
                                    {{ $festival->category->name ?? '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $festival->start_date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                @if($festival->is_active)
                                    <span class="badge bg-green-100 text-green-700">Activa</span>
                                @else
                                    <span class="badge bg-gray-100 text-gray-600">Inactiva</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
