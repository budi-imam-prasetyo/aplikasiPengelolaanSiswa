<div class="pagination justify-content-center mb-3">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="disabled" aria-hidden="true">← Prev</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-light mx-1">← Prev</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <span class="disabled mx-1">{{ $element }}</span>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="current btn btn-primary mx-1">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="btn btn-light mx-1">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-light mx-1">Next →</a>
    @else
        <span class="disabled mx-1" aria-hidden="true">Next →</span>
    @endif
</div>
