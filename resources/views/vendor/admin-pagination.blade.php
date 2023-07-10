@if ($paginator->hasPages() && $paginator->count())
    <div class="admin-pagination">
        @if ($paginator->currentPage() != 1)
            <a class="admin-pagination__link" href="{{ $paginator->url(1) }}">1</a>
        @endif
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="admin-pagination__link _active">{{ $page }}</span>
                    @else
                        @if ($page != 1 && $page != $paginator->lastPage())
                            <a class="admin-pagination__link" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- {{$paginator->lastPage()}} --}}
        @if ($paginator->currentPage() != $paginator->lastPage())
            <a class="admin-pagination__link"
                href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
        @endif
    </div>
@endif
