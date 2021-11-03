<section class="lg:sticky lg:top-8">
    <div class="space-y-2">
        <div class="flex justify-between items-center">
            <div class="text-lg font-semibold">
                <a href="{{ route('course_show', $course->slug) }}" class="transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none">{{ $course->name }}</a>
            </div>
            <div class="text-base font-medium">
                <a href="{{ route('course_edit', $course->slug) }}" class="@if(Request::routeIs('course_edit', $course->slug)) text-indigo-500 @endif transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none"><i class="fas fa-edit fa-fw"></i></a>
            </div>
        </div>
    </div>
    <hr class="my-5 border-t-2 border-gray-200">
    <div class="space-y-3">
        <div class="flex justify-between items-center">
            <div class="text-lg font-semibold">{{ __('course.navbar.bab') }}</div>
            <div class="text-base font-medium">
                <a href="{{ route('bab_create', $course->slug) }}" class="@if(Request::routeIs('bab_create', $course->slug)) text-indigo-500 @endif transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none"><i class="fas fa-plus fa-fw"></i></a>
            </div>
        </div>
        <div class="ml-5 space-y-2">
            @foreach($babs as $bab)
                <div class="font-medium text-base">
                    <a href="{{ route('bab_edit', [$course->slug, $bab->slug]) }}" class="@if(!Request::routeIs('bab_create', $course->slug) && !Request::routeIs('course_edit', $course->slug) && $bab->id == Request::route()->courseBab->id ?? $bab->id) text-indigo-500 @endif transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none">
                        <div class="flex justify-between items-center">
                            {{ $bab->name }}
                            <i class="fas fa-edit fa-fw"></i>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
