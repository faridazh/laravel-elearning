<nav class="border-b-2 font-medium tracking-wide">
    @if(in_array($user->role_id, [1,2,3]))
        <a class="inline-block px-4 py-2 @if(Request::routeIs('profile', $user->username)) text-indigo-500 @endif transition duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('profile', $user->username) }}">{{ __('profile.templates.nav.kursus') }}</a>
    @else
        <a class="inline-block px-4 py-2 @if(Request::routeIs('profile', $user->username)) text-indigo-500 @endif transition duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('profile', $user->username) }}">{{ __('profile.templates.nav.pembelajaran') }}</a>
    @endif
    <a class="inline-block px-4 py-2 transition @if(Request::routeIs('profile_forums', $user->username)) text-indigo-500 @endif duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('profile_forums', $user->username) }}">{{ __('profile.templates.nav.forum') }}</a>
    <a class="inline-block px-4 py-2 transition @if(Request::routeIs('profile_reviews', $user->username)) text-indigo-500 @endif duration-300 hover:text-indigo-500 focus:outline-none" href="{{ route('profile_reviews', $user->username) }}">{{ __('profile.templates.nav.ulasan') }}</a>
</nav>
