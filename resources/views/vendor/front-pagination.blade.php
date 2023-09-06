@if ($paginator->hasPages() && $paginator->count())
    <div class="pagination">
        @if ($paginator->currentPage() != 1)
            <a class="pagination__link" href="{{ $paginator->query()->url(1) }}">1</a>
        @endif
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination__link _active">{{ $page }}</span>
                    @else
                        @if ($page != 1 && $page != $paginator->lastPage())
                            <a class="pagination__link" href="{{ $url->query() }}">{{ $page }}</a>
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->currentPage() != $paginator->lastPage())
            <a class="pagination__link"
                href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
        @endif
    </div>
@endif
