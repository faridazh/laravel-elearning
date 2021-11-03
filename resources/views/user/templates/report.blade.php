<div x-data="{ showModal: false }" class="absolute top-5 right-5">
    <button @click="showModal = !showModal" class="px-2 py-1 rounded-lg bg-transparent text-xl text-red-500 font-medium ring-2 ring-transparent transition duration-100 hover:ring-red-500 focus:text-red-600 focus:ring-red-600 focus:outline-none"><i class="fas fa-exclamation-circle"></i></button>
    <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 filter drop-shadow-2xl bg-black bg-opacity-70 left-0 right-0 top-0 bottom-0" style="display: none" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in delay-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
        <div x-show="showModal" @click.away="showModal = false" class="relative bg-white rounded-xl shadow-2xl p-6 w-full max-w-md m-auto" x-transition:enter="transition ease-out delay-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" style="display: none;">
            <div class="font-bold block text-2xl mb-5">Laporkan Anggota</div>
            <div class="mb-5">
                <form action="#" method="post" class="grid grid-cols-1 gap-4">
                    @csrf
                    <div>
                        <label for="credential" class="block text-sm font-medium text-gray-700">Username atau Email</label>
                        <div class="mt-1">
                            <input type="text" name="credential" id="credential" class="px-3 py-2 w-full text-sm text-gray-900 ring-2 ring-gray-200 rounded-md transition duration-100 focus:ring-indigo-500 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" class="px-3 py-2 w-full text-sm text-gray-900 ring-2 ring-gray-200 rounded-md transition duration-100 focus:ring-indigo-500 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-2">
                            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 appearance-none text-white rounded-sm bg-white ring-2 ring-gray-300 transition duration-100 checked:bg-indigo-500 checked:ring-indigo-500">
                            <label for="remember" class="text-sm font-medium text-gray-700">Ingat raya</label>
                        </div>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition delay-100 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">Masuk</button>
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
