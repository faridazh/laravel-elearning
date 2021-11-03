<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @hasSection('headerCSS')
        @yield('headerCSS')
    @endif

    <script defer src="{{ asset('js/app.js') }}"></script>
    @hasSection('headerJS')
        @yield('headerJS')
    @endif

    @if(!empty($page_title))
        <title>{{ $page_title . ' - ' . env('APP_NAME', 'Laravel E-Learning') }}</title>
    @else
        <title>{{ env('APP_NAME', 'Laravel E-Learning')}}</title>
    @endif
</head>
<body class="font-inter antialiased text-base overflow-x-hidden bg-white text-gray-800">
    <header x-data="{ open: false }" class="bg-white border-b-2">
        <nav>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="cursor-pointer">
                                <img class="block h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="{{ env('APP_NAME', 'Laravel E-Learning') }}">
                            </a>
                        </div>
                        <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                            <a href="{{ route('courses') }}" class="@if(Request::route()->getPrefix() == '/kursus' || Request::is('kursus/*')) border-indigo-500 text-indigo-500 @else border-transparent hover:border-indigo-500 hover:text-indigo-500 @endif text-gray-900 inline-flex font-medium items-center px-1 pt-1 border-b-2 transition duration-300">{{ __('custom.header.kursus') }}</a>
                            <a href="#" class="border-transparent text-gray-900 inline-flex font-medium items-center px-1 pt-1 border-b-2 transition duration-300 hover:border-indigo-500 hover:text-indigo-500">{{ __('custom.header.forum') }}</a>
                            <a href="#" class="border-transparent text-gray-900 inline-flex font-medium items-center px-1 pt-1 border-b-2 transition duration-300 hover:border-indigo-500 hover:text-indigo-500">{{ __('custom.header.membership') }}</a>
                            <a href="{{ route('about') }}" class="@if(Request::routeIs('about')) border-indigo-500 text-indigo-500 @else border-transparent hover:border-indigo-500 hover:text-indigo-500 @endif text-gray-900 inline-flex font-medium items-center px-1 pt-1 border-b-2 transition duration-300">{{ __('custom.header.about') }}</a>
                        </div>
                    </div>
                    @auth
                        <div class="hidden sm:ml-6 sm:flex sm:items-center">
                            <div x-data="{ open: false }" @keydown.escape.stop="open = false" @click.away="open = false" class="ml-3 relative">
                                <div>
                                    <button type="button" class="bg-white rounded-full flex text-sm border-2 hover:border-gray-300 focus:outline-none focus:border-indigo-400" @click="open = !open" x-bind:aria-expanded="open">
                                        <img class="h-7 w-7 rounded-full" src="{{ asset('uploads/avatars/'.Auth::user()->avatar) }}" alt="" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                                    </button>
                                </div>
                                <div x-show="open" class="origin-top-right absolute right-0 w-52 z-50 mt-2 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="divide-y whitespace-normal">
                                        <div class="block p-5">
                                            <div class="text-sm font-medium mb-2">{{ Auth::user()->name }}</div>
                                            <div class="text-xs font-medium text-gray-500">{{ '@' . Auth::user()->username }}</div>
                                        </div>
                                        <div>
                                            <a href="{{ route('profile', Auth::user()->username) }}" class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('custom.header.profil') }}</a>
                                            <a href="{{ route('setting') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('custom.header.pengaturan') }}</a>
                                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('custom.header.logout') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-2">
                            {{-- Login Modal --}}
                            @include('templates.formLogin')
                        </div>
                    @endauth
                    {{-- Mobile Menu --}}
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 text-2xl text-gray-400 hover:text-gray-500 focus:outline-none" aria-controls="mobile-menu" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                            <i class="fas fa-bars h-6 w-6 block" :class="{ 'hidden': open, 'block': !(open) }"></i>
                            <i class="fas fa-times h-6 w-6 hidden" :class="{ 'block': open, 'hidden': !(open) }"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{-- Mobile Menu Body --}}
            <div class="sm:hidden" id="mobile-menu" x-show="open" style="display: none;" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 -translate-y-4" x-transition:enter-end="transform opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="transform opacity-100 translate-y-0" x-transition:leave-end="transform opacity-0 -translate-y-4">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('courses') }}" class="@if(Request::routeIs('courses')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ __('custom.header.kursus') }}</a>
                    <a href="#" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ __('custom.header.forum') }}</a>
                    <a href="#" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ __('custom.header.membership') }}</a>
                    <a href="{{ route('about') }}" class="@if(Request::routeIs('about')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ __('custom.header.about') }}</a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    @auth
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full border-2" src="{{ asset('uploads/avatars/'.Auth::user()->avatar) }}" alt="" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ '@' . Auth::user()->username }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('profile', Auth::user()->username) }}" class="@if(Request::routeIs('profile')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ __('custom.header.profil') }}</a>
                            <a href="{{ route('setting') }}" class="@if(Request::routeIs('setting')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ __('custom.header.pengaturan') }}</a>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('custom.header.logout') }}</a>
                        </div>
                    @else
                        <div class="flex flex-col px-4 text-center">
                            <a href="{{ route('register') }}" class="flex-grow px-4 py-2 mt-2 text-sm font-medium bg-indigo-500 text-white rounded-lg ring-2 ring-transparent transition duration-100 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">{{ __('custom.header.daftar') }}</a>
                            <div class="font-medium text-sm text-gray-600 mt-3">{{ __('custom.header.ask.account') }}<a href="{{ route('login') }}" class="text-indigo-500 hover:text-indigo-600">{{ __('custom.header.masuk') }}</a></div>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
        {{-- Breadcumb --}}
        @hasSection('breadcumb')
            <div class="hidden sm:block bg-gray-100 border-t-2">
                @yield('breadcumb')
            </div>
        @endif
    </header>
