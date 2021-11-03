@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('user-profile-ulasan', $user) }}@endsection

@section('content')
    @include('user.templates.header')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
                @include('user.templates.info')
                <div class="col-span-full lg:col-span-3">
                    <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : @if(in_array($user->role_id, [1,2,3])) 'kursus' @else 'pembelajaran' @endif }" id="tab_wrapper" class="grid grid-cols-1 gap-4 lg:gap-8">
                        @include('user.templates.navbar')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                            @forelse($reviews as $review)
                                <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm">
                                    <div class="flex flex-row space-x-5">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('uploads/courses/'.$review->course->slug.'/'.$review->course->image) }}" alt="" class="h-10 w-10 rounded-full ring ring-gray-200 mx-auto" onerror="this.src='{{ asset('images/default_image.jpg') }}'">
                                        </div>
                                        <div class="flex flex-col w-full">
                                            <div class="mb-3">
                                                <div class="flex flex-row justify-between items-center mb-2">
                                                    <div class="font-medium text-base">
                                                        <a href="{{ route('course_review', $review->course->slug) }}" class="hover:text-indigo-500 focus:text-indigo-600 focus:outline-none">{{ $review->course->name }}</a>
                                                    </div>
                                                    <div class="text-xs text-yellow-500">
                                                        @for($i = 0; $i < $review->stars; $i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="text-sm">{{ $review->review }}</div>
                                            </div>
                                            <div class="mt-auto text-right text-xs"><i class="fas @if($review->created_at == $review->updated_at) fa-clock @else fa-edit @endif text-gray-600 mr-1"></i>{{ date_format($review->updated_at, 'd F Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm col-span-full">
                                    <div>{{ $user->name . __('profile.ulasan.no.content') }}</div>
                                </div>
                            @endforelse
                        </div>
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
