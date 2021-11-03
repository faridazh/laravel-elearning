<div class="grid grid-cols-1 gap-4 lg:gap-8 lg:sticky lg:top-8">
    <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm space-y-2">
        <a href="{{ route('setting-account') }}" class="@if(Request::routeIs('setting-account')) bg-gray-50 text-indigo-700 hover:text-indigo-700 hover:bg-white @else text-gray-900 hover:text-gray-900 hover:bg-gray-50 @endif group rounded-md px-3 py-2 flex items-center text-sm font-medium">
            <i class="fas fa-user-circle fa-fw text-lg flex-shrink-0 -ml-1 mr-3 @if(Request::routeIs('setting-account')) text-indigo-500 group-hover:text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif"></i>
            <span class="truncate">{{ __('navbar.profile.title') }}</span>
        </a>
        <a href="{{ route('setting-private') }}" class="@if(Request::routeIs('setting-private')) bg-gray-50 text-indigo-700 hover:text-indigo-700 hover:bg-white @else text-gray-900 hover:text-gray-900 hover:bg-gray-50 @endif group rounded-md px-3 py-2 flex items-center text-sm font-medium">
            <i class="fas fa-user-lock fa-fw text-lg flex-shrink-0 -ml-1 mr-3 @if(Request::routeIs('setting-private')) text-indigo-500 group-hover:text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif"></i>
            <span class="truncate">{{ __('navbar.private.title') }}</span>
        </a>
        <a href="{{ route('setting-password') }}" class="@if(Request::routeIs('setting-password')) bg-gray-50 text-indigo-700 hover:text-indigo-700 hover:bg-white @else text-gray-900 hover:text-gray-900 hover:bg-gray-50 @endif group rounded-md px-3 py-2 flex items-center text-sm font-medium">
            <i class="fas fa-lock fa-fw text-lg flex-shrink-0 -ml-1 mr-3 @if(Request::routeIs('setting-password')) text-indigo-500 group-hover:text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif"></i>
            <span class="truncate">{{ __('navbar.password.title') }}</span>
        </a>
        <hr class="border-t-2">
        <a href="{{ route('setting-forum') }}" class="@if(Request::routeIs('setting-forum')) bg-gray-50 text-indigo-700 hover:text-indigo-700 hover:bg-white @else text-gray-900 hover:text-gray-900 hover:bg-gray-50 @endif group rounded-md px-3 py-2 flex items-center text-sm font-medium">
            <i class="fas fa-comments fa-fw text-lg flex-shrink-0 -ml-1 mr-3 @if(Request::routeIs('setting-forum')) text-indigo-500 group-hover:text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif"></i>
            <span class="truncate">{{ __('navbar.forum.title') }}</span>
        </a>
        <a href="{{ route('setting-balasan') }}" class="@if(Request::routeIs('setting-balasan')) bg-gray-50 text-indigo-700 hover:text-indigo-700 hover:bg-white @else text-gray-900 hover:text-gray-900 hover:bg-gray-50 @endif group rounded-md px-3 py-2 flex items-center text-sm font-medium">
            <i class="fas fa-reply fa-fw text-lg flex-shrink-0 -ml-1 mr-3 @if(Request::routeIs('setting-balasan')) text-indigo-500 group-hover:text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif"></i>
            <span class="truncate">{{ __('navbar.forum.reply.title') }}</span>
        </a>
        <a href="{{ route('setting-ulasan') }}" class="@if(Request::routeIs('setting-ulasan')) bg-gray-50 text-indigo-700 hover:text-indigo-700 hover:bg-white @else text-gray-900 hover:text-gray-900 hover:bg-gray-50 @endif group rounded-md px-3 py-2 flex items-center text-sm font-medium">
            <i class="fas fa-star fa-fw text-lg flex-shrink-0 -ml-1 mr-3 @if(Request::routeIs('setting-ulasan')) text-indigo-500 group-hover:text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif"></i>
            <span class="truncate">{{ __('navbar.ulasan.title') }}</span>
        </a>
    </div>
</div>
