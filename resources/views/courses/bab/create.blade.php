@extends('templates.main')

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
                <div class="col-span-full lg:col-span-1">
                    @include('courses.nav')
                </div>
                <div class="col-span-full lg:col-span-3">
                    <form action="{{ route('bab_create', $course->slug) }}" method="post">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 lg:gap-8">
                            <div class="space-y-2">
                                <div>
                                    <label for="urutan" class="font-medium">{{ __('course.bab.urutan') }}</label>
                                </div>
                                <input type="number" name="urutan" id="urutan" value="{{ old('urutan') ?? $lastOrder }}" min="1" max="99" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('urutan') border-red-400 @enderror">
                                @error('urutan')
                                <div class="mt-1 text-sm text-red-700">
                                    <div>*{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <label for="judul" class="font-medium">{{ __('course.bab.judul') }}</label>
                                </div>
                                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('judul') border-red-400 @enderror">
                                @error('judul')
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
            </div>
        </div>
    </section>
@endsection
