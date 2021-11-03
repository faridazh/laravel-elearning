@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('user-profile', $user) }}@endsection

@section('content')
    @include('user.templates.header')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
                @include('user.templates.info')
                <div class="col-span-full lg:col-span-3">
                    <div class="grid grid-cols-1 gap-4 lg:gap-8">
                        @include('user.templates.navbar')
                        @if(!in_array($user->role_id, [1,2,3]))
                            <div x-show="tab === 'pembelajaran'" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 -translate-y-4" x-transition:enter-end="transform opacity-100 translate-y-0">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
                                    @forelse($my_courses as $course)
                                        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm">
                                            <div class="mb-5">
                                                <div class="font-medium text-lg">
                                                    <a href="{{ route('course_show', $course->course->slug) }}" target="_blank" class="pb-0.5 transition duration-100 hover:text-indigo-500 focus:text-indigo-900 focus:outline-none">{{ $course->course->name }}</a>
                                                </div>
                                                <div class="mt-2 mb-3 text-sm text-gray-400">{{ html_entity_decode(Str::limit(strip_tags($course->course->description), 100)) }}</div>
                                                <div class="mt-1 text-xs">
                                                    <div><i class="fas fa-clock fa-fw mr-1"></i>{{ date_format($course->created_at, 'd F Y') }}</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                @if($course->completed == false)
                                                    <div class="inline-block py-1 px-2 font-semibold tracking-wide bg-yellow-500 text-white rounded-full text-xs">{{ __('profile.index.proses') }}</div>
                                                @elseif($course->completed == true)
                                                    <div class="inline-block py-1 px-2 font-semibold tracking-wide bg-green-500 text-white rounded-full text-xs">{{ __('profile.index.selesai') }}</div>
                                                @endif
                                                <div>
                                                    <a href="{{ route('course_show', $course->course->slug) }}" class="pb-0.5 border-b-2 border-transparent text-indigo-500 text-sm transition duration-300 hover:border-indigo-400 focus:text-indigo-500 focus:outline-none">{{ __('profile.index.lihat') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm col-span-full">{{ $user->name . __('profile.index.no.belajar') }}</div>
                                    @endforelse
                                </div>
                            </div>
                        @else
                            <div x-show="tab === 'kursus'" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 -translate-y-4" x-transition:enter-end="transform opacity-100 translate-y-0">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
                                    @forelse($my_courses as $course)
                                        <div class="flex flex-col p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm">
                                            <div class="mb-5">
                                                <div class="font-medium text-lg">
                                                    <a href="{{ route('course_show', $course->slug) }}" target="_blank" class="pb-0.5 transition duration-100 hover:text-indigo-500 focus:text-indigo-500 focus:outline-none">{{ $course->name }}</a>
                                                </div>
                                                <div class="mt-2 text-sm text-gray-400">{{ Str::limit(html_entity_decode(strip_tags($course->description)), 100) }}</div>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mt-1 flex flex-row justify-between items-center space-x-5">
                                                    <div class="text-xs"><i class="fas fa-list fa-fw mr-2"></i>{{ $course->category->name }}</div>
                                                    <div class="text-xs"><i class="fas fa-clock fa-fw mr-2"></i>{{ date_format($course->created_at, 'd F Y') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm col-span-full">{{ $user->name . __('profile.index.no.kursus') }}</div>
                                    @endforelse
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
