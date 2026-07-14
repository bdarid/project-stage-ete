<div class="hidden sm:flex sm:items-center sm:justify-between">

    <div>
        <p class="text-sm text-slate-400">
            Affichage de
            <span class="font-bold text-white">{{ $paginator->firstItem() ?? 0 }}</span>
            à
            <span class="font-bold text-white">{{ $paginator->lastItem() ?? 0 }}</span>
            sur
            <span class="font-bold text-blue-400">{{ $paginator->total() }}</span>
            résultats
        </p>
    </div>

    <div>
        <div class="flex items-center gap-2">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())

                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 text-slate-600 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0"
                              clip-rule="evenodd"/>
                    </svg>
                </span>

            @else

                <a href="{{ $paginator->previousPageUrl() }}"
                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 text-slate-300 hover:bg-slate-700 hover:border-blue-500 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0"
                              clip-rule="evenodd"/>
                    </svg>
                </a>

            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)

                @if (is_string($element))

                    <span class="px-3 text-slate-500">
                        {{ $element }}
                    </span>

                @endif

                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/20">
                                {{ $page }}
                            </span>

                        @else

                            <a href="{{ $url }}"
                               class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 text-slate-300 hover:bg-slate-700 hover:border-blue-500 hover:text-white transition">
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())

                <a href="{{ $paginator->nextPageUrl() }}"
                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 text-slate-300 hover:bg-slate-700 hover:border-blue-500 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0"
                              clip-rule="evenodd"/>
                    </svg>
                </a>

            @else

                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 text-slate-600 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0"
                              clip-rule="evenodd"/>
                    </svg>
                </span>

            @endif

        </div>
    </div>

</div>