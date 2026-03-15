<x-admin-layout>

<div class="flex items-center justify-between mb-6">
    <h1 class="text-xl font-bold text-gray-950">Eventos</h1>
</div>

{{-- Filter tabs --}}
<div class="flex gap-1 mb-6 border-b border-gray-200">
    @foreach([''=>'Todos', 'pendiente'=>'Pendientes', 'aprobado'=>'Aprobados', 'inactivo'=>'Inactivos'] as $val => $label)
        <a href="{{ route('admin.eventos.index', ['estado' => $val]) }}"
           class="px-4 py-2 text-sm font-medium border-b-2 transition-colors
                  {{ request('estado', '') === $val
                     ? 'border-accent text-accent'
                     : 'border-transparent text-gray-500 hover:text-gray-800' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-100 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Evento</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide hidden md:table-cell">Municipio</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide hidden lg:table-cell">Inicio</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide hidden lg:table-cell">Propuesto por</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Estado</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($events as $event)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <p class="font-medium text-gray-900 line-clamp-1">{{ $event->name }}</p>
                        @if($event->musicGenre)
                            <p class="text-xs text-gray-400">{{ $event->musicGenre->name }}</p>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600 hidden md:table-cell">{{ $event->municipality->name }}</td>
                    <td class="px-4 py-3 text-gray-600 hidden lg:table-cell tabular-nums">
                        {{ $event->starts_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-4 py-3 text-gray-500 hidden lg:table-cell">
                        {{ $event->submittedBy?->name ?? '—' }}
                    </td>
                    <td class="px-4 py-3">
                        @if(!$event->is_active)
                            <span class="badge border border-gray-200 text-gray-500">Inactivo</span>
                        @elseif($event->isApproved())
                            <span class="badge bg-green-50 border border-green-200 text-green-700">Publicado</span>
                        @else
                            <span class="badge bg-yellow-50 border border-yellow-200 text-yellow-700">Pendiente</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            @if(!$event->isApproved())
                                <form action="{{ route('admin.eventos.approve', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs text-green-600 hover:text-green-800 font-medium">
                                        Aprobar
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('admin.eventos.edit', $event) }}" class="text-xs text-gray-500 hover:text-gray-800">
                                Editar
                            </a>
                            <form action="{{ route('admin.eventos.destroy', $event) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar este evento?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-400 hover:text-red-600">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-10 text-center text-gray-400 text-sm">No hay eventos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($events->hasPages())
    <div class="mt-6">{{ $events->links() }}</div>
@endif

</x-admin-layout>
