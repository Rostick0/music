@php
    $if_paginate = $paginator->hasPages() && $paginator->count();
@endphp

<div class="pagination" @if (!$if_paginate) style="display:none;" @endif>
    @if ($if_paginate)
        @if ($paginator->currentPage() != 1)
            <a class="pagination__link" href="{{ $paginator->url(1) }}">1</a>
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
    @endif
</div>
