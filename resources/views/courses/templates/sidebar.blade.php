<div class="col-span-full lg:col-span-1">
    <div class="grid grid-cols-1 gap-4 lg:gap-8 lg:sticky lg:top-8">
        @auth
            @if($course->premium == false)
                <div class="pb-2 text-center text-xl font-semibold border-b-2">{{ __('course.gratis') }}</div>
                @if($course->author_id == Auth::user()->id)
                    <div class="px-4 py-2 bg-blue-100 border border-blue-300 rounded">{{ __('course.sidebar.author') }}</div>
                @elseif(in_array(Auth::user()->role_id, [1,2]))
                    <div class="px-4 py-2 bg-red-100 border border-red-300 rounded">{{ __('course.sidebar.staff') }}</div>
                    <form action="{{ route('course_favs', $course->slug) }}" method="POST">
                        @csrf
                        @if($courseFavs == false)
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-transparent text-red-500 text-base font-medium ring-2 ring-red-500 transition duration-300 hover:text-white hover:bg-red-400 hover:ring-red-400 focus:ring-red-300 focus:outline-none">{{ __('course.sidebar.favorite.tambah') }}<i class="far fa-heart ml-2"></i></button>
                        @else
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-red-400 text-white text-base font-medium ring-2 ring-red-300 transition duration-300 hover:text-red-500 hover:bg-transparent hover:ring-red-400 focus:ring-red-500 focus:outline-none">{{ __('course.sidebar.favorite.hapus') }}<i class="far fa-heart ml-2"></i></button>
                        @endif
                    </form>
                @elseif($courseDaftar == false && !in_array(Auth::user()->role_id, [1,2]))
                    <div class="px-4 py-2 bg-yellow-200 border border-yellow-300 rounded">{{ __('course.sidebar.member.unregister') }}</div>
                    <div class="flex">
                        <form action="{{ route('daftar_kursus', $course->slug) }}" method="post" class="w-full">
                            @csrf
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">{{ __('course.sidebar.daftar') }}</button>
                        </form>
                    </div>
                @elseif($courseDaftar == true && !in_array(Auth::user()->role_id, [1,2]))
                    <div class="px-4 py-2 bg-green-200 border border-green-300 rounded">{{ __('course.sidebar.member.registered') }}</div>
                    <form action="{{ route('course_favs', $course->slug) }}" method="POST">
                        @csrf
                        @if($courseFavs == false)
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-transparent text-red-500 text-base font-medium ring-2 ring-red-500 transition duration-300 hover:text-white hover:bg-red-400 hover:ring-red-400 focus:ring-red-300 focus:outline-none">{{ __('course.sidebar.favorite.tambah') }}<i class="far fa-heart ml-2"></i></button>
                        @else
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-red-400 text-white text-base font-medium ring-2 ring-red-300 transition duration-300 hover:text-red-500 hover:bg-transparent hover:ring-red-400 focus:ring-red-500 focus:outline-none">{{ __('course.sidebar.favorite.hapus') }}<i class="far fa-heart ml-2"></i></button>
                        @endif
                    </form>
                @endif
            @elseif($course->premium == true && Auth::user()->role->premium == true)
                <div class="pb-2 text-center text-xl font-semibold border-b-2" style="color: #c99356; border-color: #c99356;">{!! __('course.premium.star') !!}</div>
                @if($course->author_id == Auth::user()->id)
                    <div class="px-4 py-2 bg-blue-100 border border-blue-300 rounded">{{ __('course.sidebar.author') }}</div>
                @elseif(in_array(Auth::user()->role_id, [1,2]))
                    <div class="px-4 py-2 bg-red-100 border border-red-300 rounded">{{ __('course.sidebar.staff') }}</div>
                    <form action="{{ route('course_favs', $course->slug) }}" method="POST">
                        @csrf
                        @if($courseFavs == false)
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-transparent text-red-500 text-base font-medium ring-2 ring-red-500 transition duration-300 hover:text-white hover:bg-red-400 hover:ring-red-400 focus:ring-red-300 focus:outline-none">{{ __('course.sidebar.favorite.tambah') }}<i class="far fa-heart ml-2"></i></button>
                        @else
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-red-400 text-white text-base font-medium ring-2 ring-red-300 transition duration-300 hover:text-red-500 hover:bg-transparent hover:ring-red-400 focus:ring-red-500 focus:outline-none">{{ __('course.sidebar.favorite.hapus') }}<i class="far fa-heart ml-2"></i></button>
                        @endif
                    </form>
                @elseif($courseDaftar == false && !in_array(Auth::user()->role_id, [1,2]))
                    <div class="px-4 py-2 bg-yellow-200 border border-yellow-300 rounded">{{ __('course.sidebar.member.unregister') }}</div>
                    <div class="flex">
                        <form action="{{ route('daftar_kursus', $course->slug) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">{{ __('course.sidebar.daftar') }}</button>
                        </form>
                    </div>
                @elseif($courseDaftar == true && !in_array(Auth::user()->role_id, [1,2]))
                    <div class="px-4 py-2 bg-green-200 border border-green-300 rounded">{{ __('course.sidebar.member.registered') }}</div>
                    <form action="{{ route('course_favs', $course->slug) }}" method="POST">
                        @csrf
                        @if($courseFavs == false)
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-transparent text-red-500 text-base font-medium ring-2 ring-red-500 transition duration-300 hover:text-white hover:bg-red-400 hover:ring-red-400 focus:ring-red-300 focus:outline-none">{{ __('course.sidebar.favorite.tambah') }}<i class="far fa-heart ml-2"></i></button>
                        @else
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-red-400 text-white text-base font-medium ring-2 ring-red-300 transition duration-300 hover:text-red-500 hover:bg-transparent hover:ring-red-400 focus:ring-red-500 focus:outline-none">{{ __('course.sidebar.favorite.hapus') }}<i class="far fa-heart ml-2"></i></button>
                        @endif
                    </form>
                @endif
            @else
                <div class="pb-2 text-center text-xl font-semibold border-b-2" style="color: #c99356; border-color: #c99356;">{!! __('course.premium.star') !!}</div>
                <div class="px-4 py-2 bg-blue-100 border border-blue-200 rounded">{{ __('course.sidebar.member.unpremium') }}</div>
                <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">{{ __('course.sidebar.membership.buy') }}</button>
            @endif
        @else
            <div class="grid grid-cols-1 gap-4">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-800 font-medium text-center ring-2 ring-gray-200 transition duration-100 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fas fa-sign-in-alt mr-2"></i>{{ __('auth.login') }}</a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded bg-indigo-500 text-white font-medium text-center ring-2 ring-transparent transition duration-100 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-user-plus mr-2"></i>{{ __('auth.register') }}</a>
            </div>
        @endauth
    </div>
</div>
