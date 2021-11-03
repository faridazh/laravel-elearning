@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('setting-private') }}@endsection

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 lg:gap-8 items-start lg:grid-cols-4">
                @include('user.settings.nav')
                <div class="grid grid-cols-1 gap-4 lg:gap-8 lg:col-span-3 space-y-6">
                    <form action="{{ route('user-profile-information.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm space-y-5">
                            <div class="grid grid-cols-1 gap-4 lg:gap-8">
                                <div class="space-y-1 border-b-2 pb-1">
                                    <div class="text-xl leading-6 font-medium text-gray-900">{{ __('profile.setting.private.title') }}</div>
                                    <div class="text-sm text-gray-500">{{ __('profile.setting.private.detail') }}</div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="name" class="text-sm font-medium">{{ __('profile.setting.private.fullname') }}</label>
                                    </div>
                                    <input type="text" name="name" id="name" value="{{ old('name') ?? Auth::user()->name }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none">
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label for="email" class="text-sm font-medium">{{ __('profile.setting.private.email') }}</label>
                                    </div>
                                    <input type="text" name="email" id="email" value="{{ old('email') ?? Auth::user()->email }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none">
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                                    <div class="space-y-2">
                                        <div>
                                            <label for="birthday" class="text-sm font-medium">{{ __('profile.setting.private.birth') }}</label>
                                        </div>
                                        <input type="date" name="birthday" id="birthday" value="{{ old('birthday') ?? Auth::user()->birthday }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <div>
                                            <label class="text-sm font-medium">{{ __('profile.setting.private.gender') }}</label>
                                        </div>
                                        <div class="space-y-0.5">
                                            <div class="flex items-center space-x-2">
                                                <input class="h-4 w-4 appearance-none rounded-full bg-white border-2 border-gray-300 transition duration-100 checked:bg-indigo-400 checked:border-indigo-400 cursor-pointer" type="radio" name="gender" id="gender1" value="1" @if(Auth::user()->gender == 1) checked @endif>
                                                <label class="text-gray-700 cursor-pointer" for="gender1">{{ __('profile.setting.private.gender.1') }}</label>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <input class="h-4 w-4 appearance-none rounded-full bg-white border-2 border-gray-300 transition duration-100 checked:bg-indigo-400 checked:border-indigo-400 cursor-pointer" type="radio" name="gender" id="gender2" value="2" @if(Auth::user()->gender == 2) checked @endif>
                                                <label class="text-gray-700 cursor-pointer" for="gender2">{{ __('profile.setting.private.gender.2') }}</label>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <input class="h-4 w-4 appearance-none rounded-full bg-white border-2 border-gray-300 transition duration-100 checked:bg-indigo-400 checked:border-indigo-400 cursor-pointer" type="radio" name="gender" id="gender0" value="0" @if(Auth::user()->gender == 0) checked @endif>
                                                <label class="text-gray-700 cursor-pointer" for="gender0">{{ __('profile.setting.private.gender.0') }}</label>
                                            </div>
                                        </div>
                                    </div>
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
