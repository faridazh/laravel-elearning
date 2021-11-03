@if(Request::routeIs('course_show', $course->slug))
    <nav class="border-b-2 font-medium tracking-wide">
        <a class="inline-block px-4 py-2 transition duration-300 hover:text-indigo-500 focus:outline-none" :class="{ 'text-indigo-500': tab === 'deskripsi' }" @click.prevent="tab = 'deskripsi'; window.location.hash = 'deskripsi'" href="#">{{ __('course.navbar.deskripsi') }}</a>
        <a class="inline-block px-4 py-2 transition duration-300 hover:text-indigo-500 focus:outline-none" :class="{ 'text-indigo-500': tab === 'materi' }" @click.prevent="tab = 'materi'; window.location.hash = 'materi'" href="#">{{ __('course.navbar.materi') }}</a>
        <a class="inline-block px-4 py-2 transition duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('course_forum', $course->slug) }}">{{ __('course.navbar.forum') }}</a>
        <a class="inline-block px-4 py-2 transition duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('course_review', $course->slug) }}">{{ __('course.navbar.ulasan') }}</a>
    </nav>
@else
    <nav class="border-b-2 font-medium tracking-wide">
        <a class="inline-block px-4 py-2 transition duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('course_show', $course->slug) }}">{{ __('course.navbar.deskripsi') }}</a>
        <a class="inline-block px-4 py-2 transition duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('course_show', $course->slug).'#materi' }}">{{ __('course.navbar.materi') }}</a>
        <a class="inline-block px-4 py-2 @if(Request::routeIs('course_forum', $course->slug)) text-indigo-500 @endif transition duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('course_forum', $course->slug) }}">{{ __('course.navbar.forum') }}</a>
        <a class="inline-block px-4 py-2 @if(Request::routeIs('course_review', $course->slug)) text-indigo-500 @endif transition duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('course_review', $course->slug) }}">{{ __('course.navbar.ulasan') }}</a>
    </nav>
@endif
