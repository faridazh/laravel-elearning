@foreach($courses as $course)
    <div class="flex flex-col h-full bg-white ring-2 ring-transparent rounded-lg shadow transition duration-300 ease-in-out hover:shadow-lg hover:ring-gray-200">
        <img class="rounded-t-lg max-h-52" src="{{ asset('uploads/courses/'.$course->slug.'/'.$course->image) }}" alt="" loading="lazy" onerror="this.src='{{ asset('images/default_image.jpg') }}'">
        <div class="flex flex-row -mt-2.5 px-4 text-2xs font-semibold uppercase">
            <div class="flex flex-row space-x-2">
                <a href="#" target="_blank" class="inline-block bg-indigo-500 text-white ring-2 ring-indigo-300 rounded-full tracking-wider px-2 py-1 transition duration-300 hover:bg-white hover:text-indigo-500">
                    <span>{{ $course->category->name }}</span>
                </a>
            </div>
            <span class="inline-block @if($course->premium == false) bg-gray-500 ring-gray-300 @else ring-yellow-100 @endif text-white ring-2 rounded-full tracking-wider px-2 py-1 ml-auto" @if($course->premium == true) style="background-color: #c99356" @endif>@if($course->premium == false) {{ __('course.gratis') }} @else {{ __('course.premium') }} @endif</span>
        </div>
        <div class="py-2 px-4 mt-4">
            <div class="text-lg font-medium leading-6 text-black hover:text-indigo-600 cursor-pointer">
                <a href="{{ route('course_show', $course->slug) }}">{{ $course->name }}</a>
            </div>
        </div>
        <div class="px-4 mb-4">
            <div class="text-gray-400 font-normal leading-5 tracking-wide text-sm">{{ Str::limit(html_entity_decode(strip_tags($course->description)), 100) }}</div>
        </div>
        <div class="flex flex-row items-end h-full w-full px-4">
            <div class="flex border-t border-gray-200 w-full py-4">
                <div class="flex items-center space-x-3 border-gray-200 w-full">
                    <a href="{{ route('profile', $course->author->username) }}" target="_blank">
                        <img class="object-cover w-8 h-8 border-2 border-gray-300 rounded-full hover:border-indigo-400" src="{{ asset('uploads/avatars/' . $course->author->avatar) }}" alt="" loading="lazy" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                    </a>
                    <div>
                        <div class="text-sm font-semibold hover:text-indigo-600 cursor-pointer">
                            <a href="{{ route('profile', $course->author->username) }}" target="_blank">{{ $course->author->name }}</a>
                        </div>
                        <div class="text-xs tracking-wide">{{ date_format($course->created_at, 'd F Y') }}</div>
                    </div>
                </div>
                <div class="flex flex-col items-center flex-shrink-0 px-2">
                    <div class="flex items-center space-x-1 text-red-500">
                        <i class="fas fa-heart fa-fw mt-0.5"></i>
                        <div class="text-sm font-medium">{{ number_format($course->likes) }}</div>
                    </div>
                    <div class="flex items-center space-x-1 text-blue-500">
                        <i class="fas fa-book-open fa-fw mt-0.5"></i>
                        <div class="text-sm font-medium">{{ number_format($course->reads) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
