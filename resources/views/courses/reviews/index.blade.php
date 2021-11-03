@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('kursus-ulasan-index', $course) }}@endsection

@section('content')
    @include('courses.templates.header')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl pb-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
                @include('courses.templates.sidebar')
                <div class="col-span-full lg:col-span-3">
                    <div class="grid grid-cols-1 gap-4 lg:gap-8">
                        @include('courses.templates.navbar')
                        @auth
                            @if($courseDaftar == true && $courseReviewed == false && !in_array(Auth::user()->role_id, [1,2]) && $course->author_id != Auth::user()->id)
                                @include('courses.reviews.rating')
                            @endif
                        @endauth
                        <div class="flex flex-col lg:flex-row place-self-center justify-center w-full space-x-0 space-y-2 lg:space-x-5 lg:space-y-0">
                            <form action="{{ route('course_review', $course->slug) }}" method="GET">
                                <button name="bintang" type="submit" value="semua" class="px-3 py-1 border-2 border-gray-200 rounded-lg text-sm">{{ __('course.review.all') }}</button>
                                <button name="bintang" type="submit" value="1" class="px-3 py-1 border-2 border-gray-200 rounded-lg text-sm"><i class="fas fa-star text-yellow-500"></i></button>
                                <button name="bintang" type="submit" value="2" class="px-3 py-1 border-2 border-gray-200 rounded-lg text-sm"><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i></button>
                                <button name="bintang" type="submit" value="3" class="px-3 py-1 border-2 border-gray-200 rounded-lg text-sm"><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i></button>
                                <button name="bintang" type="submit" value="4" class="px-3 py-1 border-2 border-gray-200 rounded-lg text-sm"><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i></button>
                                <button name="bintang" type="submit" value="5" class="px-3 py-1 border-2 border-gray-200 rounded-lg text-sm"><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i><i class="fas fa-star text-yellow-500"></i></button>
                            </form>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                            @forelse($courseReviews as $review)
                                <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm">
                                    <div class="flex flex-row space-x-5">
                                        <div class="flex-shrink-0">
                                            @if($review->hidename == false)
                                                <img src="{{ asset('uploads/avatars/'.$review->user->avatar) }}" alt="" class="max-h-10 rounded-full ring ring-gray-200 mx-auto" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                                            @else
                                                <img src="{{ asset('images/default_avatar.png') }}" alt="" class="max-h-10 rounded-full ring ring-gray-200 mx-auto">
                                            @endif
                                        </div>
                                        <div class="w-full">
                                            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-2">
                                                <div class="font-medium text-base">
                                                    @if($review->hidename == false)
                                                        <a href="{{ route('profile', $review->user->username) }}" class="hover:text-indigo-500 focus:text-indigo-600 focus:outline-none">{{ $review->user->name }}</a>
                                                    @else
                                                        <div>{{ __('course.review.anonim') }}</div>
                                                    @endif
                                                </div>
                                                <div class="text-xs text-yellow-500">
                                                    @for($i = 0; $i < $review->stars; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="text-sm">{{ $review->review }}</div>
                                            <div class="mt-3 text-right text-xs"><i class="fas @if($review->created_at == $review->updated_at) fa-clock @else fa-edit @endif text-gray-600 mr-1"></i>{{ date_format($review->updated_at, 'd F Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm col-span-full">
                                    <div>{{ __('course.review.nothing') }}</div>
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-5">
                            {{ $courseReviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
