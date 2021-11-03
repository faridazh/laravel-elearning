@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('setting-password') }}@endsection

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 lg:gap-8 items-start lg:grid-cols-4">
                @include('user.settings.nav')
                <div class="grid grid-cols-1 gap-4 lg:gap-8 lg:col-span-3 space-y-6">
                    <form action="{{ route('user-password.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm space-y-5">
                            <div class="grid grid-cols-1 gap-4 lg:gap-8">
                                <div class="space-y-1 border-b-2 pb-1">
                                    <div class="text-xl leading-6 font-medium text-gray-900">{{ __('profile.setting.password.title') }}</div>
                                    <div class="text-sm text-gray-500">{{ __('profile.setting.password.detail') }}</div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="current_password" class="text-sm font-medium">{{ __('profile.setting.password.sekarang') }}</label>
                                    </div>
                                    <input type="password" name="current_password" id="current_password" value="" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('current_password', 'updatePassword') border-red-400 @enderror">
                                    @error('current_password', 'updatePassword')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="border"></div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="password" class="text-sm font-medium">{{ __('profile.setting.password.baru') }}</label>
                                    </div>
                                    <input type="password" name="password" id="password" value="" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('password', 'updatePassword') border-red-400 @enderror">
                                    @error('password', 'updatePassword')
                                    <div class="mt-1 text-sm text-red-700">
                                        <div>*{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="password_confirmation" class="text-sm font-medium">{{ __('profile.setting.password.konfirmasi') }}</label>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation" value="" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none">
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
@endsection
