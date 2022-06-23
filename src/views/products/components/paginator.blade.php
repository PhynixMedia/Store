
@if ($paginator->hasPages())
<div class="paginatoin-area">
     <div class="row">
        <div class="col-lg-12 col-md-12">
            <ul class="pagination-box">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span><i class="fa fa-angle-left"></i></span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left"></i></a></li>
        @endif

        @if($paginator->currentPage() > 3)
            <li class="hidden-xs"><a href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 4)
            <li><span>...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="current active"><a class="active" href="javascript:;">{{ $i }}</a></li>
                @else
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li><span>...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right"></i></a></li>
        @else
            <li class="disabled"><span><i class="fa fa-angle-right"></i></span></li>
        @endif
    </ul>
    </div>
    </div>
    </div>
@endif