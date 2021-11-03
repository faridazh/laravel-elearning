@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('user-profile-forum', $user) }}@endsection

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
                            @forelse($forums as $forum)
                                <div class="flex flex-col p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm">
                                    <div class="mb-5">
                                        <div class="font-medium text-lg">
                                            <a href="{{ route('course_forum_show', [$forum->course->slug, $forum->slug]) }}" target="_blank" class="pb-0.5 transition duration-100 hover:text-indigo-500 focus:text-indigo-500 focus:outline-none">{{ $forum->name }}</a>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-400">{{ Str::limit(html_entity_decode(strip_tags($forum->content)), 100) }}</div>
                                    </div>
                                    <div class="mt-auto">
                                        <div class="mt-1 flex flex-row justify-between items-center space-x-5">
                                            <div class="text-xs"><i class="fas fa-clock fa-fw mr-2"></i>{{ date_format($forum->created_at, 'd F Y') }}</div>
                                            <div class="flex items-center space-x-1 text-indigo-500 text-sm">
                                                <i class="far fa-comments fa-fw"></i>
                                                <div class="font-medium">{{ number_format($forum->replies) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm col-span-full">
                                    {{ $user->name . __('profile.forum.no.content') }}
                                </div>
                            @endforelse
                        </div>
                        {{ $forums->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
