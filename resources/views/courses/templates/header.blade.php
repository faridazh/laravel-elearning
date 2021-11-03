<section class="bg-white">
    <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row">
            <div class="rounded-lg shadow">
                <img src="{{ asset('uploads/courses/'.$course->slug.'/'.$course->image) }}" alt="" class="w-full lg:w-64 h-64 rounded-lg object-cover object-center" loading="lazy" onerror="this.src='{{ asset('images/default_image.jpg') }}'">
            </div>
            <div class="flex-grow lg:ml-5 mt-7 text-center lg:text-left">
                <div class="font-semibold text-4xl mb-5 lg:mb-10">{{ $course->name }}</div>
                <div class="text-sm">
                    <div class="mb-2"><i class="fas fa-user-edit fa-fw mr-2"></i><a href="{{ route('profile', $course->author->username) }}" target="_blank" class="hover:text-indigo-600 focus:outline-none">{{ $course->author->name }}</a></div>
                    <div class="mb-2"><i class="fas fa-list fa-fw mr-2"></i>{{ $course->category->name }}</div>
                    <div><i class="fas fa-clock fa-fw mr-2"></i>{{ date_format($course->created_at, 'd F Y') }}</div>
                </div>
            </div>
            @auth
                @if($course->author_id == Auth::user()->id || in_array(Auth::user()->role_id, [1,2]))
                    <div class="grid lg:flex items-center mt-7 lg:mt-0">
                        <a href="{{ route('course_edit', $course->slug) }}" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-center font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-edit mr-2"></i>{{ __('course.header.perbarui') }}</a>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</section>
