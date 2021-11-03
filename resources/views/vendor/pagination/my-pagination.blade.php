<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="text-center">
    @if ($paginator->lastPage() > 1)
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                {!! __('pagination.previous') !!}
            </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                {!! __('pagination.next') !!}
            </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center text-sm font-medium">
            @if($paginator->currentPage() > $paginator->onFirstPage()+2)
                <a class="relative inline-flex items-center mr-1 px-4 py-2 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150" href="{{ $paginator->url($paginator->onFirstPage()) }}" title="{!! __('pagination.first_text') !!}">{!! __('pagination.first') !!}</a>
            @endif
            @if($paginator->currentPage() > $paginator->onFirstPage())
                <a class="relative inline-flex items-center mr-3 px-4 py-2 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150" href="{{$paginator->previousPageUrl()}}" title="{!! __('pagination.previous_text') !!}">{!! __('pagination.previous') !!}</a>
            @endif
            <div class="space-x-0.5">
                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <?php
                    $half_total_links = floor(7/2);
                    $from = $paginator->currentPage() - $half_total_links;
                    $to = $paginator->currentPage() + $half_total_links;
                    if ($paginator->currentPage() < $half_total_links) {
                        $to += $half_total_links - $paginator->currentPage();
                    }
                    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
                    ?>
                    @if ($from < $i && $i < $to)
                        @if(($paginator->currentPage() == $i))
                            <span href="{{ $paginator->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-white bg-indigo-500 border border-indigo-300 leading-5 rounded-md cursor-default">{{ $i }}</span>
                        @else
                            <a href="{{ $paginator->url($i) }}" class="relative inline-flex items-center px-4 py-2 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150" @if($paginator->currentPage() == $i)) title="{!! __('pagination.now') !!}" @endif>{{ $i }}</a>
                        @endif
                    @endif
                @endfor
            </div>
            @if($paginator->currentPage() < $paginator->lastPage())
                <a class="relative inline-flex items-center ml-3 px-4 py-2 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150" href="{{ $paginator->nextPageUrl() }}" title="{!! __('pagination.next_text') !!}">{!! __('pagination.next') !!}</a>
            @endif
            @if($paginator->currentPage() < $paginator->lastPage()-1)
                <a class="relative inline-flex items-center ml-1 px-4 py-2 bg-white border border-gray-300 leading-5 rounded-md hover:bg-gray-100 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150" href="{{ $paginator->url($paginator->lastPage()) }}" title="{!! __('pagination.last_text') !!}">{!! __('pagination.last') !!}</a>
            @endif
        </div>
    @endif
</nav>
