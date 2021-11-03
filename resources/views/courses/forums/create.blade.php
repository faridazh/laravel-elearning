@extends('templates.main')

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-3">
                <div class="font-semibold text-3xl">
                    <a href="{{ route('course_show', $course->slug) }}" class="transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none">{{ $course->name }}</a>
                </div>
                <div class="font-medium">{{ __('course.forum.new') }}</div>
            </div>
            <hr class="border-t-2 my-10">
            <form action="{{ route('course_forum_create', $course->slug) }}" method="post">
                @csrf
                <div class="grid grid-cols-1 gap-4 lg:gap-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                        <div class="space-y-2">
                            <div>
                                <label for="judul" class="font-medium">{{ __('course.forum.form.title') }}</label>
                            </div>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('judul') border-red-400 @enderror">
                            @error('judul')
                            <div class="mt-1 text-sm text-red-700">
                                <div>*{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <div>
                                <label for="materi" class="font-medium">{{ __('course.materi') }}</label>
                            </div>
                            <select name="materi" id="materi" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('materi') border-red-400 @enderror">
                                @foreach($materis as $key => $array)
                                    @if(!empty($babs))
                                        <optgroup label="{{ $babs[$key]->name }}">
                                            @foreach($array as $materi)
                                                <option value="{{ $materi->id }}">{{ $materi->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @else
                                        @foreach($array as $materi)
                                            <option value="{{ $materi->id }}">{{ $materi->name }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            @error('materi')
                            <div class="mt-1 text-sm text-red-700">
                                <div>*{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div>
                            <label for="isiforum" class="font-medium">{{ __('course.forum.form.content') }}</label>
                        </div>
                        <textarea name="isiforum" id="isiforum" rows="10" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none ckeditor @error('isiforum') border-red-400 @enderror">{{ old('isiforum') }}</textarea>
                        @error('isiforum')
                        <div class="mt-1 text-sm text-red-700">
                            <div>*{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div class="mt-5 text-right">
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-save mr-2"></i>{{ __('course.submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('footerJS')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
