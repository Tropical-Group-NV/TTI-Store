@php($item = new \App\Http\Livewire\Items())


@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            @if($item->search_str != null)
                                <li class="page-item"><a class="page-link" href="{{ $url . '&search=' . $item->search_str }}">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif

                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    @if($item->search_str != null)
                        @if($item->brand_srch != null)
                            <a class="page-link" href="{{ $paginator->nextPageUrl() . '&search=' . $item->search_str . '&brand=' . $item->brand_srch}}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        @else
                            <a class="page-link" href="{{ $paginator->nextPageUrl() . '&search=' . $item->search_str }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        @endif
                    @else
                        @if($item->brand_srch != null)

                            <a class="page-link" href="{{ $paginator->nextPageUrl() . '&brand=11' . $item->brand_srch}}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        @else
{{--                            {{ $item->brand_srch }}--}}
                            <a class="page-link" href="{{ $paginator->nextPageUrl() . '&brand=11' . $item->brand_srch}}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        @endif
                    @endif
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
