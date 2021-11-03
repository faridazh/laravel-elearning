@extends('templates.main')

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
                <div class="col-span-full lg:col-span-1">
                    @include('courses.nav')
                </div>
                <div class="col-span-full lg:col-span-3">
                    <form action="{{ route('materi_create', [$course->slug, $courseBab->slug]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 lg:gap-8">
                            <div class="space-y-2">
                                <div>
                                    <label for="urutan" class="font-medium">{{ __('course.materi.urutan') }}</label>
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
                                    <label for="judul" class="font-medium">{{ __('course.materi.judul') }}</label>
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
                                    <label for="materi" class="font-medium">{{ __('course.materi.isi') }}</label>
                                </div>
                                <textarea name="materi" id="materi" cols="30" rows="10" class="ckeditor px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('materi') border-red-400 @enderror">{{ old('materi') }}</textarea>
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
