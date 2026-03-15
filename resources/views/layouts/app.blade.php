<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $pageTitle       = trim(strip_tags(View::yieldContent('title', 'FiestasLocales')));
        $pageDescription = trim(strip_tags(View::yieldContent('description', 'Descubre el calendario de fiestas locales de la Comunitat Valenciana.')));
        $pageImage       = View::yieldContent('og_image', asset('images/og-default.png'));
        $fullTitle       = $pageTitle === 'FiestasLocales' ? 'FiestasLocales — Comunitat Valenciana' : $pageTitle . ' — FiestasLocales';
    @endphp

    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="FiestasLocales">
    <meta property="og:title"       content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image"       content="{{ $pageImage }}">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:locale"      content="es_ES">

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image"       content="{{ $pageImage }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-white text-gray-900 antialiased min-h-screen flex flex-col">

    {{-- Navbar --}}
    <header x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">

                {{-- Wordmark --}}
                <a href="{{ route('home') }}" class="text-base font-semibold tracking-tight text-gray-950">
                    Fiestas<span class="text-accent font-bold">Locales</span>
                </a>

                {{-- Desktop nav --}}
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('festivals.index') }}"
                       class="px-3 py-1.5 text-sm text-gray-600 hover:text-gray-950 hover:bg-gray-50 rounded-md transition-colors">
                        Fiestas
                    </a>
                    <a href="{{ route('events.index') }}"
                       class="px-3 py-1.5 text-sm text-gray-600 hover:text-gray-950 hover:bg-gray-50 rounded-md transition-colors">
                        Eventos
                    </a>
                    <a href="{{ route('comarcas.show', 'camp-de-turia') }}"
                       class="px-3 py-1.5 text-sm text-gray-600 hover:text-gray-950 hover:bg-gray-50 rounded-md transition-colors">
                        Camp de Turia
                    </a>
                </nav>

                {{-- Auth --}}
                <div class="hidden md:flex items-center gap-2">
                    @auth
                        <a href="{{ route('favorites.index') }}"
                           class="px-3 py-1.5 text-sm text-gray-600 hover:text-gray-950 hover:bg-gray-50 rounded-md transition-colors">
                            Favoritos
                        </a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                               class="px-3 py-1.5 text-sm text-accent hover:text-accent-hover rounded-md transition-colors">
                                Admin
                            </a>
                        @endif
                        <div x-data="{ dropOpen: false }" class="relative">
                            <button @click="dropOpen = !dropOpen"
                                    class="flex items-center gap-1 px-3 py-1.5 text-sm text-gray-700 hover:text-gray-950 hover:bg-gray-50 rounded-md transition-colors">
                                {{ auth()->user()->name }}
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="dropOpen" @click.away="dropOpen = false" x-transition
                                 class="absolute right-0 mt-1 w-44 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                                <a href="{{ route('profile.edit') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Mi perfil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-3 py-1.5 text-sm text-gray-600 hover:text-gray-950 rounded-md transition-colors">
                            Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary text-xs py-2 px-4">
                            Registrarse
                        </a>
                    @endauth
                </div>

                {{-- Mobile burger --}}
                <button @click="open = !open" class="md:hidden p-2 text-gray-500 hover:text-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open" x-transition class="md:hidden border-t border-gray-100 bg-white px-4 py-3 space-y-0.5">
            <a href="{{ route('festivals.index') }}" class="block px-2 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-50">Fiestas</a>
            <a href="{{ route('events.index') }}" class="block px-2 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-50">Eventos</a>
            <a href="{{ route('comarcas.show', 'camp-de-turia') }}" class="block px-2 py-2 text-sm text-gray-600 rounded-md hover:bg-gray-50">Camp de Turia</a>
            <div class="pt-2 mt-2 border-t border-gray-100 space-y-0.5">
                @auth
                    <a href="{{ route('favorites.index') }}" class="block px-2 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-50">Favoritos</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="block px-2 py-2 text-sm text-accent rounded-md hover:bg-gray-50">Admin</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="block px-2 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-50">Mi perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-2 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-50">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-2 py-2 text-sm text-gray-700">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="block px-2 py-2 text-sm font-semibold text-gray-950">Registrarse</a>
                @endauth
            </div>
        </div>
    </header>

    {{-- Flash messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
             class="fixed top-16 right-4 z-50 bg-white border border-gray-200 text-gray-800 rounded-lg px-4 py-3 shadow-lg text-sm font-medium flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-green-500 shrink-0"></span>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition
             class="fixed top-16 right-4 z-50 bg-white border border-gray-200 text-gray-800 rounded-lg px-4 py-3 shadow-lg text-sm font-medium flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-red-500 shrink-0"></span>
            {{ session('error') }}
        </div>
    @endif

    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-950 text-gray-400 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
                <div class="col-span-2 md:col-span-1">
                    <p class="text-white text-sm font-semibold tracking-tight mb-3">
                        Fiestas<span class="text-accent">Locales</span>
                    </p>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        El calendario de fiestas de la Comunitat Valenciana.
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold tracking-widest uppercase text-gray-600 mb-4">Explorar</p>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('festivals.index') }}" class="hover:text-white transition-colors">Todas las fiestas</a></li>
                        <li><a href="{{ route('events.index') }}" class="hover:text-white transition-colors">Eventos con música</a></li>
                        <li><a href="{{ route('comarcas.show', 'camp-de-turia') }}" class="hover:text-white transition-colors">Camp de Turia</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-xs font-semibold tracking-widest uppercase text-gray-600 mb-4">Información</p>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Sobre nosotros</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-xs font-semibold tracking-widest uppercase text-gray-600 mb-4">Cuenta</p>
                    <ul class="space-y-2.5 text-sm">
                        @auth
                            <li><a href="{{ route('favorites.index') }}" class="hover:text-white transition-colors">Mis favoritos</a></li>
                            <li><a href="{{ route('profile.edit') }}" class="hover:text-white transition-colors">Mi perfil</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Iniciar sesión</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Crear cuenta</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-6 flex items-center justify-between text-xs text-gray-600">
                <span>© {{ date('Y') }} FiestasLocales</span>
                <span>Comunitat Valenciana</span>
            </div>
        </div>
    </footer>

</body>
</html>
