@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('setting-account') }}@endsection

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 lg:gap-8 items-start lg:grid-cols-4">
                @include('user.settings.nav')
                <div class="grid grid-cols-1 gap-4 lg:gap-8 lg:col-span-3 space-y-6">
                    <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm space-y-5">
                            <div class="grid grid-cols-1 gap-4 lg:gap-8">
                                <div class="space-y-1 border-b-2 pb-1">
                                    <div class="text-xl leading-6 font-medium text-gray-900">{{ __('profile.title') }}</div>
                                    <div class="text-sm text-gray-500">{{ __('profile.setting.account.detail') }}</div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="username" class="text-sm font-medium">{{ __('profile.username') }}</label>
                                    </div>
                                    <div class="flex rounded-lg">
                                        <div class="px-3 py-2 text-sm bg-gray-50 border-2 border-r-0 border-gray-200 rounded-l-lg items-center text-gray-500">{{ env('app_url', 'http://localhost').'/profil/' }}</div>
                                        <input type="text" name="username" id="username" value="{{ old('username') ?? Auth::user()->username }}" class="px-3 py-2 flex-grow text-sm rounded-md rounded-l-none rounded-r-md border-2 transition duration-100 focus:border-indigo-400 focus:outline-none">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="text-sm font-medium">{{ __('profile.setting.account.foto') }}</div>
                                    <div class="flex items-center space-x-5">
                                        <img src="{{ asset('uploads/avatars/'.Auth::user()->avatar) }}" alt="Foto Profil" id="previewAvatar" class="w-20 h-20 rounded-full border-2 border-gray-200" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                                        <input type="file" name="avatar" id="uploadAvatar" class="hidden">
                                        <button type="button" class="px-3 py-2 rounded-lg bg-white text-sm font-medium ring-2 ring-gray-200 transition duration-100 hover:text-white hover:bg-indigo-600 hover:ring-indigo-200 focus:ring-indigo-300 focus:outline-none" onclick="event.preventDefault(); document.getElementById('uploadAvatar').click();">{{ __('profile.setting.account.upload') }}</button>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="text-sm font-medium">{{ __('profile.setting.account.cover') }}</div>
                                    <div class="text-center space-y-5">
                                        <img src="{{ asset('uploads/covers/'.Auth::user()->cover) }}" alt="Cover Profil" id="previewCover" class="w-full h-36 rounded-md border-2 border-gray-200 object-cover" onerror="this.src='{{ asset('images/default_user_bg.jpg') }}'">
                                        <input type="file" name="cover" id="uploadCover" class="hidden">
                                        <button type="button" class="px-3 py-2 rounded-lg bg-white text-sm font-medium ring-2 ring-gray-200 transition duration-100 hover:text-white hover:bg-indigo-600 hover:ring-indigo-200 focus:ring-indigo-300 focus:outline-none" onclick="event.preventDefault(); document.getElementById('uploadCover').click();">{{ __('profile.setting.account.upload') }}</button>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="about" class="text-sm font-medium">{{ __('profile.setting.account.tentang') }}</label>
                                    </div>
                                    <textarea id="about" name="about" rows="3" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none">{{ old('about') ?? Auth::user()->about }}</textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-save mr-2"></i>{{ __('profile.setting.simpan') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        uploadAvatar.onchange = evt => {
            const [avatarPic] = uploadAvatar.files
            if (avatarPic) {
                previewAvatar.src = URL.createObjectURL(avatarPic)
            }
        }
        uploadCover.onchange = evt => {
            const [coverPic] = uploadCover.files
            if (coverPic) {
                previewCover.src = URL.createObjectURL(coverPic)
            }
        }
    </script>
@endsection
