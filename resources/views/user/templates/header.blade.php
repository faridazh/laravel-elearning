<section class="bg-white">
    <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg filter drop-shadow-lg relative">
            <div class="absolute top-0 bottom-0 left-0 right-0 -z-10 rounded-lg bg-cover bg-center" style="background-image: url({{ $user->cover ? asset('uploads/covers/'.$user->cover) : asset('images/default_user_bg.jpg') }})"></div>
            <div class="p-10 bg-gradient-to-b from-transparent to-black rounded-lg relative">
                @include('user.templates.report')
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-4 text-white">
                    <div class="mx-auto text-center">
                        <img src="{{ asset('uploads/avatars/'.$user->avatar) }}" alt="" class="max-h-36 rounded-full ring ring-gray-200 mx-auto" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                        <div class="text-center mt-10 mb-3">
                            <div class="text-2xl font-medium">{{ $user->name }}</div>
                        </div>
                        <div class="inline-block px-2 py-1 rounded text-xs font-medium shadow tracking-wide uppercase" style="background: {{ $user->role->bg_color }}; color: {{ $user->role->text_color }};"><i class="fas {{ 'fa-' . $user->role->icon }} mr-1"></i>{{ $user->role->name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
