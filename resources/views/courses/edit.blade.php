@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('kursus-edit', $course) }}@endsection

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
                            <button @click="showModal = !showModal" type="button" class="px-4 py-2 rounded-lg bg-red-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-red-600 focus:ring-red-300 focus:outline-none"><i class="fas fa-trash-alt mr-2"></i>{!! __('course.form.delete.button') !!}</button>
                            <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 filter drop-shadow-2xl bg-black bg-opacity-70 left-0 right-0 top-0 bottom-0" style="display: none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in delay-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                <div x-show="showModal" @click.away="showModal = false" class="relative bg-white rounded-xl shadow-2xl p-6 w-full max-w-md m-auto" x-transition:enter="transition ease-out delay-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="font-bold block text-2xl mb-5">{{ __('course.form.delete.title') }}</div>
                                    <div class="mb-5">
                                        <form action="{{ route('course_delete', $course->slug) }}" method="post" class="grid grid-cols-1 gap-4">
                                            @csrf
                                            @method('DELETE')
                                            <div class="text-center">
                                                <div class="mb-7">
                                                    <div class="font-semibold mb-1">{{ $course->name }}</div>
                                                    <div class="text-sm">
                                                        <div>{{ $course->author->name }} &bull; {{ $course->category->name }}</div>
                                                        <div>{{ date_format($course->created_at, 'd F Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="font-medium text-lg">{{ __('course.form.delete.confirm') }}</div>
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
                        <form action="{{ route('course_edit', $course->slug) }}" method="post" class="mt-5" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="grid grid-cols-1 gap-4 lg:gap-8">
                                <div class="space-y-2">
                                    <div>
                                        <label for="judul" class="font-medium">{{ __('course.form.judul') }}</label>
                                    </div>
                                    <input type="text" name="judul" id="judul" value="{{ old('judul') ?? $course->name }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('judul') border-red-400 @enderror">
                                    @error('judul')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="uploadImage" class="font-medium">{{ __('course.form.image') }}</label>
                                    </div>
                                    <div class="flex items-center space-x-5">
                                        <img src="{{ asset('uploads/courses/'.$course->slug.'/'.$course->image) }}" alt="" id="previewImage" class="w-48 h-32 rounded-md border-2 border-gray-200" onerror="this.src='{{ asset('images/default_image.jpg') }}'">
                                        <input type="file" name="cover" id="uploadImage" class="hidden">
                                        <button type="button" class="px-3 py-2 rounded-lg bg-white text-sm font-medium ring-2 ring-gray-200 transition duration-100 hover:text-white hover:bg-indigo-600 hover:ring-indigo-200 focus:ring-indigo-300 focus:outline-none" onclick="event.preventDefault(); document.getElementById('uploadImage').click();">{{ __('course.form.upload.image') }}</button>
                                    </div>
                                    @error('cover')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="description" class="font-medium">{{ __('course.form.desc') }}</label>
                                    </div>
                                    <textarea name="description" id="description" rows="10" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none ckeditor @error('description') border-red-400 @enderror">{{ old('description') ?? $course->description }}</textarea>
                                    @error('description')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <div>
                                            <label for="category" class="font-medium">{{ __('course.kategori') }}</label>
                                        </div>
                                        <select name="category" id="category" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('category') border-red-400 @enderror">
                                            <option value="{{ $course->category_id }}" selected>{{ $course->category->name }}</option>
                                            <optgroup label="Kategory Baru">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        @error('category')
                                        <div class="mt-1 text-sm text-red-700">
                                            <div>*{{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <div>
                                            <label for="membership" class="font-medium">{{ __('course.membership') }}</label>
                                        </div>
                                        <select name="membership" id="membership" class="px-3 py-2 w-full text-sm border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('price') border-red-400 @enderror">
                                            <option value="0" @if($course->premium == false) selected @endif>{{ __('course.gratis') }}</option>
                                            <option value="1" @if($course->premium == true) selected @endif>{{ __('course.premium') }}</option>
                                        </select>
                                        @error('membership')
                                        <div class="mt-1 text-sm text-red-700">
                                            <div>*{{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
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
@endsection

@section('footerJS')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script type="text/javascript">
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{route('ckeditor.image-upload-course-description', ['_token' => csrf_token()])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        uploadImage.onchange = evt => {
            const [coursePic] = uploadImage.files
            if (coursePic) {
                previewImage.src = URL.createObjectURL(coursePic)
            }
        }
    </script>
@endsection
