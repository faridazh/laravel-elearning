@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('kursus-forum-index', $course) }}@endsection

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
                            @if($courseDaftar == true || in_array(Auth::user()->role_id, [1,2]) || $course->author_id == Auth::user()->id)
                                <div class="ml-auto">
                                    <a href="{{ route('course_forum_create', $course->slug) }}" class="px-4 py-2 w-full text-center rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="far fa-comments mr-2"></i>{{ __('course.forum.new') }}</a>
                                </div>
                            @endif
                        @endauth
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                            @forelse($forums as $forum)
                                <div class="flex flex-col h-full bg-white border-2 border-gray-200 rounded-lg shadow-sm">
                                    <div class="py-2 px-4 mt-1">
                                        <div class="text-lg font-medium text-black hover:text-indigo-600 cursor-pointer">
                                            <a href="{{ route('course_forum_show', [$course->slug, $forum->slug]) }}">{{ $forum->name }}</a>
                                        </div>
                                    </div>
                                    <div class="px-4 mb-4">
                                        <div class="text-gray-400 text-sm">{{ html_entity_decode(Str::limit(strip_tags($forum->content), 100)) }}</div>
                                    </div>
                                    <div class="flex flex-row items-end h-full w-full px-4">
                                        <div class="flex border-t border-gray-200 w-full py-4">
                                            <div class="flex items-center space-x-3 border-gray-200 w-full">
                                                <div>
                                                    <img class="object-cover w-8 h-8 border-2 border-gray-300 rounded-full" src="{{ asset('uploads/avatars/' . $forum->author->avatar) }}" alt="" loading="lazy" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold hover:text-indigo-600 cursor-pointer">
                                                        <a href="{{ route('profile', $forum->author->username) }}" target="_blank">{{ $forum->author->name }}</a>
                                                    </div>
                                                    <div class="text-xs tracking-wide">{{ date_format($forum->created_at, 'd F Y') }}</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-1 text-indigo-500">
                                                <i class="far fa-comments fa-fw"></i>
                                                <div class="text-sm font-medium">{{ number_format($forum->replies) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm col-span-full">
                                    {{ __('course.forum.nothing') }}
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-5">
                            {{ $forums->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
