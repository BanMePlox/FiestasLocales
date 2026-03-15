<x-admin-layout>
@section('title', 'Dashboard')

<div class="space-y-8">

    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-950">Dashboard</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.fiestas.create') }}" class="btn-primary text-sm">+ Nueva fiesta</a>
        </div>
    </div>

    {{-- Alerta de eventos pendientes --}}
    @if($stats['events_pending'] > 0)
        <div class="flex items-center gap-4 rounded-lg border border-yellow-200 bg-yellow-50 px-5 py-4">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-yellow-100 text-yellow-700 font-bold text-sm">
                {{ $stats['events_pending'] }}
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-yellow-900">
                    {{ $stats['events_pending'] === 1 ? 'Hay 1 evento pendiente de aprobación' : "Hay {$stats['events_pending']} eventos pendientes de aprobación" }}
                </p>
                <p class="text-xs text-yellow-700 mt-0.5">Los usuarios están esperando que revises sus propuestas.</p>
            </div>
            <a href="{{ route('admin.eventos.index', ['estado' => 'pendiente']) }}"
               class="shrink-0 text-xs font-semibold text-yellow-800 hover:text-yellow-950 underline underline-offset-2">
                Revisar ahora →
            </a>
        </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3">
        @foreach([
            ['label' => 'Fiestas totales',   'value' => $stats['festivals'],        'sub' => $stats['festivals_active'] . ' activas'],
            ['label' => 'Eventos',            'value' => $stats['events_total'],     'sub' => $stats['events_pending'] . ' pendientes', 'alert' => $stats['events_pending'] > 0],
            ['label' => 'Municipios',         'value' => $stats['municipalities'],   'sub' => ''],
            ['label' => 'Usuarios',           'value' => $stats['users'],            'sub' => ''],
        ] as $stat)
            <div class="bg-white border {{ ($stat['alert'] ?? false) ? 'border-yellow-300' : 'border-gray-200' }} rounded-lg p-4">
                <p class="text-2xl font-bold text-gray-950">{{ $stat['value'] }}</p>
                <p class="text-xs font-medium text-gray-600 mt-0.5">{{ $stat['label'] }}</p>
                @if($stat['sub'])
                    <p class="text-xs text-gray-400 mt-1">{{ $stat['sub'] }}</p>
                @endif
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Eventos pendientes --}}
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="text-sm font-semibold text-gray-950">Eventos por aprobar</h2>
                <a href="{{ route('admin.eventos.index', ['estado' => 'pendiente']) }}"
                   class="text-xs text-gray-400 hover:text-gray-700">Ver todos</a>
            </div>
            @if($pendingEvents->isEmpty())
                <p class="px-5 py-8 text-sm text-center text-gray-400">Sin eventos pendientes.</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach($pendingEvents as $event)
                        <li class="flex items-center gap-3 px-5 py-3">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $event->name }}</p>
                                <p class="text-xs text-gray-400">
                                    {{ $event->municipality->name }}
                                    · {{ $event->starts_at->format('d/m/Y') }}
                                    @if($event->submittedBy)
                                        · por {{ $event->submittedBy->name }}
                                    @endif
                                </p>
                            </div>
                            <form action="{{ route('admin.eventos.approve', $event) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="shrink-0 text-xs font-semibold text-green-600 hover:text-green-800">
                                    Aprobar
                                </button>
                            </form>
                            <a href="{{ route('admin.eventos.edit', $event) }}"
                               class="shrink-0 text-xs text-gray-400 hover:text-gray-700">
                                Editar
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Próximos eventos (14 días) --}}
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="text-sm font-semibold text-gray-950">Próximos 14 días</h2>
                <a href="{{ route('admin.eventos.index') }}" class="text-xs text-gray-400 hover:text-gray-700">Ver todos</a>
            </div>
            @if($upcomingEvents->isEmpty())
                <p class="px-5 py-8 text-sm text-center text-gray-400">Sin eventos próximos.</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach($upcomingEvents as $event)
                        <li class="flex items-center gap-3 px-5 py-3">
                            <div class="w-10 shrink-0 text-center">
                                <p class="text-xs font-bold text-gray-950 leading-none">{{ $event->starts_at->format('d') }}</p>
                                <p class="text-xs text-gray-400 uppercase">{{ $event->starts_at->translatedFormat('M') }}</p>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $event->name }}</p>
                                <p class="text-xs text-gray-400">
                                    {{ $event->municipality->name }}
                                    @if($event->musicGenre) · {{ $event->musicGenre->name }} @endif
                                </p>
                            </div>
                            <span class="shrink-0 text-xs font-medium {{ $event->isFree() ? 'text-green-600' : 'text-gray-500' }}">
                                {{ $event->formattedPrice() }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>

    {{-- Últimas fiestas + últimos usuarios --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="text-sm font-semibold text-gray-950">Últimas fiestas añadidas</h2>
                <a href="{{ route('admin.fiestas.index') }}" class="text-xs text-gray-400 hover:text-gray-700">Ver todas</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @foreach($latestFestivals as $festival)
                    <li class="flex items-center gap-3 px-5 py-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $festival->name }}</p>
                            <p class="text-xs text-gray-400">
                                {{ $festival->municipality->name ?? '—' }}
                                · {{ $festival->start_date->format('d/m/Y') }}
                            </p>
                        </div>
                        <span class="shrink-0 text-xs {{ $festival->is_active ? 'text-green-600' : 'text-gray-400' }}">
                            {{ $festival->is_active ? 'Activa' : 'Inactiva' }}
                        </span>
                        <a href="{{ route('admin.fiestas.edit', $festival) }}"
                           class="shrink-0 text-xs text-gray-400 hover:text-gray-700">Editar</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="text-sm font-semibold text-gray-950">Últimos registros</h2>
            </div>
            <ul class="divide-y divide-gray-100">
                @foreach($latestUsers as $user)
                    <li class="flex items-center gap-3 px-5 py-3">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-100 text-xs font-semibold text-gray-600">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-gray-400">{{ $user->email }}</p>
                        </div>
                        @if($user->is_admin)
                            <span class="shrink-0 text-xs font-medium text-accent">Admin</span>
                        @endif
                        <span class="shrink-0 text-xs text-gray-400">
                            {{ $user->created_at->diffForHumans() }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

</div>

</x-admin-layout>
