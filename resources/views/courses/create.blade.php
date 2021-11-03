@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('kursus-create') }}@endsection

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <form action="{{ route('course_create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-4 lg:gap-8">
                    <div class="space-y-2">
                        <div>
                            <label for="judul" class="font-medium">{{ __('course.form.judul') }}</label>
                        </div>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="px-3 py-2 w-full text-sm border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('judul') border-red-400 @enderror">
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
                            <img src="" alt="" id="previewImage" class="w-48 h-32 rounded-md border-2 border-gray-200" onerror="this.src='{{ asset('images/default_image.jpg') }}'">
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
                            <label for="deskripsi" class="font-medium">{{ __('course.form.desc') }}</label>
                        </div>
                        <textarea name="deskripsi" id="deskripsi" rows="10" class="px-3 py-2 w-full text-sm border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none ckeditor @error('deskripsi') border-red-400 @enderror">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="mt-1 text-sm text-red-700">
                            <div>*{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                        <div class="space-y-2">
                            <div>
                                <label for="category" class="font-medium">{{ __('course.kategori') }}</label>
                            </div>
                            <select name="category" id="category" class="px-3 py-2 w-full text-sm border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('category') border-red-400 @enderror">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
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
                                <option value="0">{{ __('course.gratis') }}</option>
                                <option value="1">{{ __('course.premium') }}</option>
                            </select>
                            @error('membership')
                            <div class="mt-1 text-sm text-red-700">
                                <div>*{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-right">
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-save mr-2"></i>{{ __('course.simpan') }}</button>
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
    <script type="text/javascript">
        CKEDITOR.replace('deskripsi', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload-course-description', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
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
