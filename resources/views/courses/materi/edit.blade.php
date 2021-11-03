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
                            <button @click="showModal = !showModal" type="button" class="px-4 py-2 rounded-lg bg-red-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-red-600 focus:ring-red-300 focus:outline-none"><i class="fas fa-trash-alt mr-2"></i>{{ __('course.materi.hapus') }}</button>
                            <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 filter drop-shadow-2xl bg-black bg-opacity-70 left-0 right-0 top-0 bottom-0" style="display: none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in delay-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                <div x-show="showModal" @click.away="showModal = false" type="button" class="relative bg-white rounded-xl shadow-2xl p-6 w-full max-w-md m-auto" x-transition:enter="transition ease-out delay-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="font-bold block text-2xl mb-5">{{ __('course.materi.hapus') }}</div>
                                    <div class="mb-5">
                                        <form action="{{ route('materi_delete', [$course->slug, $courseBab->slug, $courseMateri->slug]) }}" method="post" class="grid grid-cols-1 gap-4">
                                            @csrf
                                            @method('DELETE')
                                            <div class="text-center">
                                                <div class="mb-7">
                                                    <div class="font-semibold mb-1">{{ $courseMateri->bab->course->name . ' - ' . $courseMateri->bab->name . ' - ' . $courseMateri->name }}</div>
                                                    <div class="text-sm">
                                                        <div>{{ date_format($courseMateri->created_at, 'd F Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="font-medium text-lg">{{ __('course.materi.hapus.konfirmasi') }}</div>
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
                    @if($materiFiles != null)
                        <section>
                            <div class="mt-5 space-y-2">
                                <div>
                                    <label for="materi" class="font-medium">{{ __('course.materi.berkas') }}</label>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                                    @foreach($materiFiles as $key => $file)
                                        <div class="group">
                                            <div class="p-4 rounded-lg bg-white border-2 border-gray-200 group-hover:border-indigo-400">
                                                <div class="flex flex-row items-center">
                                                    <div class="mr-4 text-center text-gray-500 group-hover:text-indigo-500">
                                                        <i class="fas fa-cloud-download-alt text-3xl"></i>
                                                    </div>
                                                    <div class="group-hover:text-indigo-500">
                                                        <a href="{{ route('materi_download', [$course->slug, $courseBab->slug, $courseMateri->slug, $key, $file]) }}" class="group cursor-pointer" target="_blank">{{ Str::studly($file) }}</a>
                                                    </div>
                                                    <div class="ml-auto text-center group-hover:text-red-500 cursor-pointer">
                                                        <form action="{{ route('berkas_delete', [$course->slug, $courseBab->slug, $courseMateri->slug, $key]) }}" method="POST" class="inline-flex">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit">
                                                                <i class="fas fa-times text-xl"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif
                    <section>
                        <form action="{{ route('materi_edit', [$course->slug, $courseBab->slug, $courseMateri->slug]) }}" method="post" class="mt-5" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="grid grid-cols-1 gap-4 lg:gap-8">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                                    <div class="space-y-2">
                                        <div>
                                            <label for="urutan" class="font-medium">{{ __('course.materi.urutan') }}</label>
                                        </div>
                                        <input type="number" name="urutan" id="urutan" value="{{ old('urutan') ?? $courseMateri->order }}" min="1" max="99" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('urutan') border-red-400 @enderror">
                                        @error('urutan')
                                        <div class="mt-1 text-sm text-red-700">
                                            <div>*{{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <div>
                                            <label for="bab" class="font-medium">{{ __('course.materi.bab') }}</label>
                                        </div>
                                        <select name="bab" id="bab" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 cursor-pointer rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('bab') border-red-400 @enderror">
                                            <option value="{{ $courseBab->id }}" selected>{{ $courseBab->name }}</option>
                                            <optgroup label="Pindahkan ke">
                                                @foreach($babs as $bab)
                                                    <option value="{{ $bab->id }}">{{ $bab->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        @error('bab')
                                        <div class="mt-1 text-sm text-red-700">
                                            <div>*{{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="judul" class="font-medium">{{ __('course.materi.judul') }}</label>
                                    </div>
                                    <input type="text" name="judul" id="judul" value="{{ old('judul') ?? $courseMateri->name }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('judul') border-red-400 @enderror">
                                    @error('judul')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="materi" class="font-medium">{{ __('course.materi.isi') }}</label>
                                    </div>
                                    <textarea name="materi" id="materi" cols="30" rows="10" class="ckeditor px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('materi') border-red-400 @enderror">{{ old('materi') ?? $courseMateri->content }}</textarea>
                                    @error('materi')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <div class="group">
                                        <label class="flex justify-center p-6 border-2 border-gray-300 group-hover:border-indigo-500 border-dashed rounded-md cursor-pointer" for="uploadFiles">
                                            <div class="space-y-5 text-center">
                                                <div class="space-y-2">
                                                    <i class="fas fa-cloud-upload-alt mx-auto text-gray-500 group-hover:text-indigo-500 text-5xl"></i>
                                                    <div class="flex justify-center font-medium text-gray-600 group-hover:text-indigo-600">
                                                        <span>{{ __('course.materi.unggah.file') }}</span>
                                                        <input id="uploadFiles" name="uploadFiles[]" type="file" class="hidden" multiple onchange="processSelectedFiles(this)">
                                                    </div>
                                                </div>
                                                <div class="space-y-1 text-sm" id="output"></div>
                                                <div class="text-xs text-gray-500">
                                                    <p>{{ $file_types }}</p>
                                                    <p>Maksimal: {{ $file_maxSize }}</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @error('uploadFiles')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mt-5 flex flex-row space-x-2 justify-end">
                                    <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-save mr-2"></i>{{ __('course.simpan') }}</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        const output = document.querySelector("#output");
        function processSelectedFiles(fileInput) {
            let files = fileInput.files;
            for (let i = 0; i < files.length; i++) {
                document.getElementById("output").innerHTML += `<div class="ml-5">${files[i].name}</div>`;
            }
        }
    </script>
@endsection

@section('footerJS')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script type="text/javascript">
        CKEDITOR.replace('materi', {
            filebrowserUploadUrl: "{{route('ckeditor.image-upload-materi', [$course->slug, $courseBab->slug, '_token' => csrf_token()])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
