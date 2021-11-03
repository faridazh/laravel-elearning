<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Font Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Tailwind CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Alpine JS --}}
    <script defer src="{{ asset('js/app.js') }}"></script>

    <title>{{ env('APP_NAME', 'Laravel E-Learning') . ' - ' . __('auth.register.register') }}</title>
</head>
<body class="font-inter antialiased text-base overflow-x-hidden bg-indigo-100 text-gray-700">
<main class="max-w-2xl mx-auto min-h-screen px-4 sm:px-6 lg:px-8">
    <div class="min-h-screen flex flex-col items-center justify-center text-left relative">
        <div class="flex text-left my-5 mr-auto">
            <a href="{{ route('home') }}" class="cursor-pointer">
                <img class="block h-9 w-auto" src="{{ asset('images/logo.png') }}" alt="{{ env('APP_NAME', 'Laravel E-Learning') }}">
            </a>
        </div>
        <div class="w-full p-8 bg-white rounded-lg filter drop-shadow-lg">
            <div>
                <div class="inline-block font-semibold text-xl uppercase tracking-wide border-b-4 border-indigo-400 text-indigo-500 pb-1.5 px-2">{{ __('auth.register.register') }}</div>
            </div>
            <div class="my-10">
                <form action="#" method="post" class="grid grid-cols-1 gap-4 lg:gap-6">
                    @csrf
                    <div>
                        <label for="name" class="text-sm font-medium text-gray-700">{{ __('auth.register.fullname') }}</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('name') border-red-400 @enderror"">
                        </div>
                        @error('name')
                        <div class="mt-1 text-sm text-red-700">
                            <div>*{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="username" class="text-sm font-medium text-gray-700">{{ __('auth.login.username') }}</label>
                        <div class="mt-1">
                            <input type="text" name="username" id="username" value="{{ old('username') }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('username') border-red-400 @enderror"">
                        </div>
                        @error('username')
                        <div class="mt-1 text-sm text-red-700">
                            <div>*{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="text-sm font-medium text-gray-700">{{ __('auth.login.email') }}</label>
                        <div class="mt-1">
                            <input type="text" name="email" id="email" value="{{ old('email') }}" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('email') border-red-400 @enderror"">
                        </div>
                        @error('email')
                        <div class="mt-1 text-sm text-red-700">
                            <div>*{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="text-sm font-medium text-gray-700">{{ __('auth.login.password2') }}</label>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('password') border-red-400 @enderror">
                        </div>
                        @error('password')
                        <div class="mt-1 text-sm text-red-700">
                            <div>*{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-sm font-medium text-gray-700">{{ __('auth.register.password.konfirmasi') }}</label>
                        <div class="mt-1">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('password') border-red-400 @enderror">
                        </div>
                        @error('password')
                        <div class="mt-1 text-sm text-red-700">
                            <div>*{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row items-center justify-between space-y-5 l:space-y-0">
                        <div class="flex flex-col space-y-2">
                            <div class="flex items-center space-x-2">
                                <input id="agree_term" name="agree_term" type="checkbox" class="h-4 w-4 appearance-none rounded-sm bg-white border-2 border-gray-300 transition duration-100 checked:bg-indigo-400 checked:border-indigo-400 cursor-pointer @error('agree_term') border-red-400 @enderror">
                                <label for="agree_term" class="text-sm font-medium text-gray-700 cursor-pointer @error('agree_term') text-red-700 @enderror">{{ __('auth.register.agree.with') }}<a class="transition duration-300 hover:text-indigo-500 focus:outline-none" href="#">{{ __('auth.register.tos') }}</a>.</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input id="agree_service" name="agree_service" type="checkbox" class="h-4 w-4 appearance-none rounded-sm bg-white border-2 border-gray-300 transition duration-100 checked:bg-indigo-400 checked:border-indigo-400 cursor-pointer @error('agree_service') border-red-400 @enderror">
                                <label for="agree_service" class="text-sm font-medium text-gray-700 cursor-pointer @error('agree_service') text-red-700 @enderror">{{ __('auth.register.agree.with') }}<a class="transition duration-300 hover:text-indigo-500 focus:outline-none" href="#">{{ __('auth.register.privacy') }}</a>.</label>
                            </div>
                        </div>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">{{ __('auth.register.register') }}</button>
                    </div>
                </form>
            </div>
            <div class="flex items-center justify-center text-sm font-medium text-gray-700">
                <span>{{ __('auth.register.ask.account') }}<a href="{{ route('login') }}" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ __('auth.login.login') }}</a></span>
            </div>
        </div>
    </div>
</main>
</body>
</html>
