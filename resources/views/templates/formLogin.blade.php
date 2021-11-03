<div x-data="{ showModal: false }">
    <button @click="showModal = !showModal" class="px-4 py-2 rounded-lg bg-transparent text-gray-800 font-medium ring-2 ring-transparent transition duration-100 hover:bg-gray-200 focus:ring-gray-300 focus:outline-none">{{ __('auth.login.login') }}</button>
    <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 filter drop-shadow-2xl bg-black bg-opacity-70 left-0 right-0 top-0 bottom-0" style="display: none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
        <div x-show="showModal" @click.away="showModal = false" class="relative bg-white rounded-xl shadow-2xl p-6 w-full max-w-md m-auto" x-transition:enter="transition ease-out delay-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
            <div class="font-bold block text-2xl mb-5">{{ __('auth.login.login') }}</div>
            <div class="mb-5">
                <form action="{{ route('login') }}" method="post" class="grid grid-cols-1 gap-4">
                    @csrf
                    <div>
                        <label for="credential" class="block text-sm font-medium text-gray-700">{{ __('auth.login.username.or.email') }}</label>
                        <div class="mt-1">
                            <input type="text" name="credential" id="credential" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none">
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('auth.login.password2') }}</label>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none">
                        </div>
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-2">
                            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 appearance-none text-white rounded-sm bg-white border-2 border-gray-300 transition duration-100 checked:bg-indigo-400 checked:border-indigo-400 cursor-pointer">
                            <label for="remember" class="text-sm font-medium text-gray-700 cursor-pointer">{{ __('auth.login.remember') }}</label>
                        </div>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium border-2 ring-transparent transition duration-100 hover:bg-indigo-600 focus:border-indigo-300 focus:outline-none">{{ __('auth.login.login') }}</button>
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
@if(Route::has('register'))
    <a href="{{ route('register') }}" target='_blank' class="px-4 py-2 rounded-lg bg-indigo-500 text-white font-medium ring-2 ring-transparent transition duration-100 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-user-plus mr-2"></i>{{ __('auth.register.register') }}</a>
@endif
