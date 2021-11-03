@extends('templates.main')

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
                <div class="col-span-full lg:col-span-1">
                    @include('courses.nav')
                </div>
                <div class="col-span-full lg:col-span-3 divide-y-2 space-y-5">
                    <section class="text-center">
                        <div x-data="{ showModal: false }">
                            <button @click="showModal = !showModal" class="px-4 py-2 rounded-lg bg-red-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-red-600 focus:ring-red-300 focus:outline-none"><i class="fas fa-trash-alt mr-2"></i>{{ __('course.bab.hapus') }}</button>
                            <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 filter drop-shadow-2xl bg-black bg-opacity-70 left-0 right-0 top-0 bottom-0" style="display: none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in delay-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                <div x-show="showModal" @click.away="showModal = false" class="relative bg-white rounded-xl shadow-2xl p-6 w-full max-w-md m-auto" x-transition:enter="transition ease-out delay-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="font-bold block text-2xl mb-5">{{ __('course.bab.hapus') }}</div>
                                    <div class="mb-5">
                                        <form action="{{ route('bab_delete', [$course->slug, $courseBab->slug]) }}" method="post" class="grid grid-cols-1 gap-4">
                                            @csrf
                                            @method('DELETE')
                                            <div class="text-center">
                                                <div class="mb-7">
                                                    <div class="font-semibold mb-1">{{ $course->name . ' - ' . $courseBab->name }}</div>
                                                    <div class="text-sm">
                                                        <div>{{ date_format($courseBab->created_at, 'd F Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="font-medium text-lg">{{ __('course.bab.hapus.konfirmasi') }}</div>
                                            </div>
                                            <div class="flex items-start justify-between">
                                                <button type="submit" class="px-4 py-2 rounded-lg bg-red-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-red-600 focus:ring-indigo-300 focus:outline-none">{{ __('course.hapus') }}</button>
                                                <div @click="showModal = !showModal" class="px-4 py-2 rounded-lg bg-gray-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-600 focus:ring-indigo-300 focus:outline-none cursor-pointer">{{ __('course.batal') }}</div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="text-right space-x-5 mt-5">
                                        <div @click="showModal = !showModal" class="absolute top-5 right-5 text-2xl cursor-pointer hover:text-red-600 focus:outline-none">
                                            <i class="fas fa-times fa-fw"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <form action="{{ route('bab_edit', [$course->slug, $courseBab->slug]) }}" method="post" class="mt-5">
                            @csrf
                            @method('PATCH')
                            <div class="grid grid-cols-1 gap-4 lg:gap-8">
                                <div class="space-y-2">
                                    <div>
                                        <label for="urutan" class="font-medium">{{ __('course.bab.urutan') }}</label>
                                    </div>
                                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan') ?? $courseBab->order ?? 1 }}" min="1" max="99" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('urutan') border-red-400 @enderror">
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
                                    <input type="text" name="judul" id="judul" value="{{ old('judul') ?? $courseBab->name }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('judul') border-red-400 @enderror">
                                    @error('judul')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="flex ml-auto items-center mt-5 space-x-2">
                                    <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-save mr-2"></i>{{ __('course.simpan') }}</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <section>
                        <div class="flex justify-between items-center my-5">
                            <div class="font-semibold text-xl">{{ __('course.materi') }}</div>
                            <a href="{{ route('materi_create', [$course->slug, $courseBab->slug]) }}" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-plus mr-2"></i>{{ __('course.bab.materi.baru') }}</a>
                        </div>
                        <div class="space-y-2">
                            @foreach($courseMateri as $materi)
                                <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm">
                                    <div class="flex justify-between items-center">
                                        <div class="font-medium">
                                            <a href="{{ route('course_materi', [$course->slug, $courseBab->slug, $materi->slug]) }}" class="transition duration-300 hover:text-indigo-500 focus:text-indigo-600 focus:outline-none">{{ $materi->name }}</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('materi_edit', [$course->slug, $courseBab->slug, $materi->slug]) }}" class="px-3 py-2 rounded-lg bg-indigo-500 text-white text-sm font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-edit mr-2"></i>{{ __('course.perbarui') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
