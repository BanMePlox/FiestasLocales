<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — FiestasLocales Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-white flex flex-col shrink-0">
        <div class="p-5 border-b border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-xl">🎉</span>
                <span class="font-display font-bold text-white">FiestasLocales</span>
            </a>
            <p class="text-gray-400 text-xs mt-0.5">Panel de administración</p>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.fiestas.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.fiestas.*') ? 'bg-primary-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                🎉 Fiestas
            </a>
            <a href="{{ route('admin.categorias.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.categorias.*') ? 'bg-primary-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                🏷️ Categorías
            </a>
            <a href="{{ route('admin.municipios.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.municipios.*') ? 'bg-primary-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                📍 Municipios
            </a>
            <a href="{{ route('admin.eventos.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.eventos.*') ? 'bg-accent text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                🎵 Eventos
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800">
            <a href="{{ route('home') }}" class="block text-xs text-gray-400 hover:text-white mb-2">← Ver sitio público</a>
            <p class="text-xs text-gray-500">{{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs text-gray-400 hover:text-white mt-1">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    {{-- Main area --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        <main class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                     class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium">
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

</div>

</body>
</html>
