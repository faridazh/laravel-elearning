        <footer class="border-t-2">
            <section class="bg-gray-100">
                <div class="max-w-3xl mx-auto lg:max-w-7xl py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-6 gap-10 text-left text-gray-800 justify-center lg:justify-start">
                        <div class="col-span-full lg:col-span-3">
                            <div class="flex flex-row items-center space-x-2 justify-center lg:justify-start">
                                <a href="{{ route('home') }}" class="inline-block cursor-pointer">
                                    <img class="block h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="{{ env('APP_NAME', 'Laravel E-Learning') }}">
                                </a>
                            </div>
                            <div class="mt-5 text-sm mr-0 xl:mr-16 text-center lg:text-left">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>
                        <div class="hidden lg:block">
                            <div class="uppercase tracking-wide font-semibold text-indigo-500 mb-3">Links</div>
                            <div class="flex flex-col text-sm space-y-3">
                                <a href="#" class="transition duration-300 hover:text-indigo-500 focus:outline-none">Home</a>
                                <a href="#" class="transition duration-300 hover:text-indigo-500 focus:outline-none">Home</a>
                                <a href="#" class="transition duration-300 hover:text-indigo-500 focus:outline-none">Home</a>
                            </div>
                        </div>
                        <div class="hidden lg:block">
                            <div class="uppercase tracking-wide font-semibold text-indigo-500 mb-3">Links</div>
                            <div class="flex flex-col text-sm space-y-3">
                                <a href="#" class="transition duration-300 hover:text-indigo-500 focus:outline-none">Home</a>
                                <a href="#" class="transition duration-300 hover:text-indigo-500 focus:outline-none">Home</a>
                                <a href="#" class="transition duration-300 hover:text-indigo-500 focus:outline-none">Home</a>
                            </div>
                        </div>
                        <div class="hidden md:block text-center lg:text-left">
                            <div class="uppercase tracking-wide font-semibold text-indigo-500 mb-3">Kontak Kami</div>
                            <div class="flex flex-col text-sm space-y-3">
                                <div>(+62) 812 3456 7890</div>
                                <a href="mailto:help@email.com" class="transition duration-300 hover:text-indigo-500 focus:outline-none">help@email.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-gray-100">
                <div class="max-w-3xl mx-auto lg:max-w-7xl py-4 px-4 sm:px-6 lg:px-8 border-t">
                    <div class="text-gray-500 text-sm text-center md:flex">
                        <div><a href="{{ route('home') }}" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ env('APP_NAME', 'Laravel E-Learning') }}</a> &copy; {{ date('Y', time()) }}. All rights reserved.</div>
                        <div class="ml-auto">Developed by <a href="https://zeddcode.com" class="transition duration-300 hover:text-indigo-500 focus:outline-none">ZeddCode</a>.</div>
                    </div>
                </div>
            </section>
        </footer>
        @auth
            <form action="{{ route('logout') }}" method="post" id="logout-form" class="hidden">
                @csrf
            </form>
        @endauth
    </body>
    @include('sweetalert::alert')
    @hasSection('footerJS')
        @yield('footerJS')
    @endif
</html>
