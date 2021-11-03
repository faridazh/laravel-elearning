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

    <title>{{ env('APP_NAME', 'Laravel E-Learning') . ' - ' . __('auth.login.login') }}</title>
</head>
<body class="font-inter antialiased text-base overflow-x-hidden bg-indigo-100 text-gray-700">
    <main class="max-w-2xl mx-auto max-h-screen px-4 sm:px-6 lg:px-8">
        <div class="min-h-screen flex flex-col items-center justify-center text-left relative">
            <div class="flex text-left mb-5 mr-auto">
                <a href="{{ route('home') }}" class="cursor-pointer">
                    <img class="block h-9 w-auto" src="{{ asset('images/logo.png') }}" alt="{{ env('APP_NAME', 'Laravel E-Learning') }}" title="{{ env('APP_NAME', 'Laravel E-Learning') }}">
                </a>
            </div>
            <div class="w-full p-8 bg-white rounded-lg filter drop-shadow-lg">
                <div>
                    <div class="inline-block font-semibold text-xl uppercase tracking-wide border-b-4 border-indigo-400 text-indigo-500 pb-1.5 px-2">{{ __('auth.login.login') }}</div>
                </div>
                <div class="my-10">
                    <form action="{{ route('login') }}" method="post" class="grid grid-cols-1 gap-4 lg:gap-8">
                        @csrf
                        <div>
                            <label for="credential" class="text-sm font-medium text-gray-700">{{ __('auth.login.username.or.email') }}</label>
                            <div class="mt-1">
                                <input type="text" name="credential" id="credential" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('credential') border-red-400 @enderror">
                            </div>
                            @error('credential')
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
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-2">
                                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 appearance-none rounded-sm bg-white border-2 border-gray-300 transition duration-100 checked:bg-indigo-400 checked:border-indigo-400 cursor-pointer">
                                <label for="remember" class="text-sm font-medium text-gray-700 cursor-pointer">{{ __('auth.login.remember') }}</label>
                            </div>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">{{ __('auth.login.login') }}</button>
                        </div>
                    </form>
                </div>
                <div class="flex items-center justify-center space-x-5 text-sm font-medium">
                    <a href="#" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ __('auth.login.forgot.password') }}</a>
                    <a href="{{ route('register') }}" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ __('auth.login.register2') }}</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
