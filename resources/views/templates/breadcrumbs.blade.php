@unless ($breadcrumbs->isEmpty())
    <ol class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex space-x-4 text-xs font-medium py-2">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$loop->last && !is_null($breadcrumb->url))
                <li class="hover:text-indigo-600 focus:text-indigo-700 focus:outline-none">
                    <a href="{{ $breadcrumb->url }}" class="no-underline">{!! $breadcrumb->title !!}</a>
                </li>
                <li>
                    <i class="fas fa-angle-right fa-fw"></i>
                </li>
            @elseif (!$loop->last && is_null($breadcrumb->url))
                <li>{!! $breadcrumb->title !!}</li>
                <li>
                    <i class="fas fa-angle-right fa-fw"></i>
                </li>
            @else
                <li class="font-semibold text-indigo-600">{!! $breadcrumb->title !!}</li>
            @endif
        @endforeach
    </ol>
@endunless
