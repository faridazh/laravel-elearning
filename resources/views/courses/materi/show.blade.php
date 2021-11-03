@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('kursus-materi', $course, $courseMateri) }}@endsection

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
                <div class="col-span-full lg:col-span-1">
                    <div class="lg:sticky lg:top-8 space-y-5">
                        <section class="grid grid-cols-1 gap-4">
                            <a href="{{ route('course_forum_create', [$course->slug, $courseBab->slug, $courseMateri->slug]) }}" class="px-4 py-2 rounded bg-gray-200 text-gray-800 font-medium text-center ring-2 ring-gray-200 transition duration-100 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none" target="_blank"><i class="fas fa-comments mr-2"></i>{{ __('course.materi.diskusikan') }}</a>
                            <a href="#" class="px-4 py-2 rounded bg-gray-200 text-gray-800 font-medium text-center ring-2 ring-gray-200 transition duration-100 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fas fa-exclamation-circle mr-2"></i>{{ __('course.materi.laporkan') }}</a>
                        </section>
                        <hr class="border-t-2">
                        <section>
                            <div class="bg-white border border-gray-200 rounded-md max-h-96 overflow-y-auto">
                                <ul class="rounded-lg">
                                    @foreach($listBab as $babkey => $bab)
                                        <li class="border-b border-gray-200" x-data="{ selected:null }">
                                            <div @if($bab->id == $courseBab->id) class="border-b border-gray-200 bg-indigo-50" @else :class="{'border-b border-gray-200 bg-indigo-50':selected == {{ $babkey }}}" @endif>
                                                <button type="button" class="w-full px-5 py-4 text-left" @click="selected !== {{ $babkey }} ? selected = {{ $babkey }} : selected = null">
                                                    <div class="flex items-center justify-between">
                                                        <span class="font-medium">{{ $bab->name }}</span>
                                                        <i class="fas fa-angle-down transition duration-400" :class="{'fa-rotate-180': selected == {{ $babkey }}}"></i>
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="overflow-hidden transition-all max-h-0 duration-500" x-ref="container0" x-bind:style="selected == {{ $babkey }} ? 'max-height: ' + $refs.container0.scrollHeight + 'px' : ''">
                                                <div class="p-6 space-y-2">
                                                    @foreach($listMateri[$babkey] as $materi)
                                                        <div class="font-medium">
                                                            <a href="{{ route('course_materi', [$course->slug, $bab->slug, $materi->slug]) }}" class="transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none @if($materi->id == $courseMateri->id) text-indigo-500 @endif">{{ $materi->name }}</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-span-full lg:col-span-3">
                    <section>
                        <div class="text-center space-y-2">
                            <div class="font-semibold text-3xl">
                                <a href="{{ route('course_show', $course->slug) }}" class="transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none">{{ $course->name }}</a>
                            </div>
                            <div class="font-medium text-lg">{{ $courseBab->name }} - {{ $courseMateri->name }}</div>
                        </div>
                        <hr class="border-t-2 mt-2 mb-10">
                    </section>
                    <article>
                        {!! $courseMateri->content !!}
                    </article>
                    @if($materiFiles != null)
                        <hr class="border-t border-gray-200 my-5">
                        <div class="space-y-2">
                            <div>
                                <label for="materi" class="font-medium">{{ __('course.materi.berkas') }}</label>
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                                @foreach($materiFiles as $filekey => $file)
                                    <a href="{{ route('materi_download', [$course->slug, $courseBab->slug, $courseMateri->slug, $filekey, $file]) }}" class="group cursor-pointer">
                                        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 group-hover:border-indigo-400">
                                            <div class="flex flex-row items-center">
                                                <div class="mr-4 text-center text-gray-500 group-hover:text-indigo-500">
                                                    <i class="fas fa-cloud-download-alt text-3xl"></i>
                                                </div>
                                                <div class="group-hover:text-indigo-500">{{ Str::studly($file) }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
