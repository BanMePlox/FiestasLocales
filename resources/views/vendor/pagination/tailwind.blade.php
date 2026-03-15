@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación" class="flex items-center justify-between gap-4">

        {{-- Resumen --}}
        <p class="text-xs text-gray-400 hidden sm:block">
            Mostrando
            <span class="font-medium text-gray-700">{{ $paginator->firstItem() }}</span>–<span class="font-medium text-gray-700">{{ $paginator->lastItem() }}</span>
            de
            <span class="font-medium text-gray-700">{{ $paginator->total() }}</span>
        </p>

        {{-- Controles --}}
        <div class="flex items-center gap-1">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-3 py-1.5 text-xs text-gray-300 border border-gray-200 rounded-md cursor-not-allowed select-none">
                    ← Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="inline-flex items-center px-3 py-1.5 text-xs text-gray-600 border border-gray-200 rounded-md hover:border-gray-400 hover:text-gray-950 transition-colors">
                    ← Anterior
                </a>
            @endif

            {{-- Páginas --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 py-1.5 text-xs text-gray-400 select-none">…</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold bg-gray-950 text-white rounded-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="inline-flex items-center px-3 py-1.5 text-xs text-gray-600 border border-gray-200 rounded-md hover:border-gray-400 hover:text-gray-950 transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="inline-flex items-center px-3 py-1.5 text-xs text-gray-600 border border-gray-200 rounded-md hover:border-gray-400 hover:text-gray-950 transition-colors">
                    Siguiente →
                </a>
            @else
                <span class="inline-flex items-center px-3 py-1.5 text-xs text-gray-300 border border-gray-200 rounded-md cursor-not-allowed select-none">
                    Siguiente →
                </span>
            @endif

        </div>
    </nav>
@endif
