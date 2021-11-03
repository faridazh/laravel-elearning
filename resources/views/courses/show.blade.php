@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('kursus-show', $course) }}@endsection

@section('content')
    @include('courses.templates.header')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl pb-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
                @include('courses.templates.sidebar')
                <div class="col-span-full lg:col-span-3">
                    <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'deskripsi' }" id="tab_wrapper" class="grid grid-cols-1 gap-4 lg:gap-8">
                        @include('courses.templates.navbar')
                        <div x-show="tab === 'deskripsi'" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 -translate-y-4" x-transition:enter-end="transform opacity-100 translate-y-0">
                            <article class="overflow-hidden whitespace-normal">
                                {!! $course->description !!}
                            </article>
                        </div>
                        <div x-show="tab === 'materi'" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 -translate-y-4" x-transition:enter-end="transform opacity-100 translate-y-0">
                            <div class="bg-white border border-gray-200 rounded-lg">
                                <ul class="rounded-lg">
                                    @foreach($courseBab as $key => $bab)
                                        <li class="border-b border-gray-200" x-data="{selected:null}">
                                            <div :class="{'border-b border-gray-200 bg-indigo-50': selected == {{ $key }}}">
                                                <button type="button" class="w-full px-5 py-4 text-left" @click="selected !== {{ $key }} ? selected = {{ $key }} : selected = null">
                                                    <div class="flex items-center justify-between">
                                                        <span class="font-medium">{{ $bab->name }}</span>
                                                        <i class="fas fa-angle-down transition duration-400" :class="{'fa-rotate-180': selected == {{ $key }}}"></i>
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="overflow-hidden transition-all max-h-0 duration-500" x-ref="{{ 'container'.$key }}" x-bind:style="selected == {{ $key }} ? 'max-height: ' + {{'$refs.container'.$key.'.scrollHeight'}} + 'px' : ''">
                                                <div class="p-6 space-y-2">
                                                    <ul class="list-inside list-disc">
                                                        @auth
                                                            @if(Auth::check() && $courseDaftar == true || in_array(Auth::user()->role_id, [1,2]) || $course->author_id == Auth::user()->id)
                                                                @foreach($courseMateri[$key] as $materi)
                                                                    <li class="font-medium">
                                                                        <a href="{{ route('course_materi', [$course->slug, $bab->slug, $materi->slug]) }}" class="transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none">{{ $materi->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            @else
                                                                @foreach($courseMateri[$key] as $materi)
                                                                    <li class="font-medium">{{ $materi->name }}</li>
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            @foreach($courseMateri[$key] as $materi)
                                                                <li class="font-medium">{{ $materi->name }}</li>
                                                            @endforeach
                                                        @endauth
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
