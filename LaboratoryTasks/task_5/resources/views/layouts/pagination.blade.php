@php
    /** @var \Illuminate\Contracts\Pagination\Paginator $paginator */
@endphp
@if ($paginator)
<nav aria-label="Pagination" class="d-flex justify-content-between align-items-center mt-3">
    <div>
        Страница {{ $paginator->currentPage() }} од {{ method_exists($paginator, 'lastPage') ? $paginator->lastPage() : ($paginator->hasMorePages() ? $paginator->currentPage() + 1 : $paginator->currentPage()) }}
    </div>
    <ul class="pagination mb-0">
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}" tabindex="{{ $paginator->onFirstPage() ? '-1' : '0' }}">Претходна</a>
        </li>
        @if (method_exists($paginator, 'lastPage'))
            @php
                $last = $paginator->lastPage();
                $current = $paginator->currentPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
            @endphp
            @for ($page = $start; $page <= $end; $page++)
                <li class="page-item {{ $page === $current ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                </li>
            @endfor
        @else
            <li class="page-item active"><span class="page-link">{{ $paginator->currentPage() }}</span></li>
        @endif
        <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}" tabindex="{{ $paginator->hasMorePages() ? '0' : '-1' }}">Следна</a>
        </li>
    </ul>
</nav>
@endif

