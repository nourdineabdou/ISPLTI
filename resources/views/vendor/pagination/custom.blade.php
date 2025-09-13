@if ($paginator->hasPages())
    @php
        // window size for pagination (how many pages around current)
        $window = 2; // show current +/- 2
        $lastPage = $paginator->lastPage();
        $current = $paginator->currentPage();
        $start = max(1, $current - $window);
        $end = min($lastPage, $current + $window);
    @endphp

    <nav aria-label="Pagination">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="mb-2 mb-md-0 text-muted small">
                {{-- affichage x-y sur z résultats --}}
                @php
                    $from = ($paginator->perPage() * ($current - 1)) + 1;
                    $to = min($paginator->perPage() * $current, $paginator->total());
                @endphp
                Affichage <strong>{{ $from }}</strong>–<strong>{{ $to }}</strong> sur <strong>{{ $paginator->total() }}</strong> résultats
            </div>

            <ul class="pagination mb-0 justify-content-center">
                {{-- Previous Page Link with SVG --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 12L5 8l4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Précédent">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 12L5 8l4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </li>
                @endif

                {{-- First page and left ellipsis --}}
                @if($start > 1)
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
                    @if($start > 2)
                        <li class="page-item disabled"><span class="page-link">&hellip;</span></li>
                    @endif
                @endif

                {{-- page links window --}}
                @for($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                {{-- right ellipsis and last page --}}
                @if($end < $lastPage)
                    @if($end < $lastPage - 1)
                        <li class="page-item disabled"><span class="page-link">&hellip;</span></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a></li>
                @endif

                {{-- Next Page Link with SVG --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Suivant">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span></li>
                @endif
            </ul>
        </div>
    </nav>

    <style>
        /* mobile adjustments: hide page numbers except current and neighbors */
        @media (max-width: 576px) {
            .pagination li.page-item { display: none; }
            .pagination li.page-item.active, .pagination li.page-item:nth-child(n+1) { display: inline-block; }
            /* show previous/next and active only */
            .pagination li.page-item:first-child, .pagination li.page-item:last-child, .pagination li.page-item.active { display:inline-block !important; }
        }
    </style>
@endif
