@if($paginator->hasPages())
    <div class="pagination-bar">
        <span>صفحه {{ $paginator->currentPage() }} از {{ $paginator->lastPage() }} · نمایش {{ $paginator->firstItem() }} تا {{ $paginator->lastItem() }}</span>
        <div class="pagination-actions">
            @if($paginator->onFirstPage())<i>صفحه قبل</i>@else<a href="{{ $paginator->previousPageUrl() }}"><x-portal.icon name="chevron-left" style="transform:rotate(180deg)" /> صفحه قبل</a>@endif
            @if($paginator->hasMorePages())<a href="{{ $paginator->nextPageUrl() }}">صفحه بعد <x-portal.icon name="chevron-left" /></a>@else<i>صفحه بعد</i>@endif
        </div>
    </div>
@endif
