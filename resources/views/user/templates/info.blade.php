<div class="col-span-full lg:col-span-1">
    <div class="grid grid-cols-1 gap-4 lg:gap-8">
        <div class="px-4 py-2 border-b-2 font-medium text-indigo-500">{{ __('profile.templates.info.status') }}</div>
        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm space-y-4">
            <div class="pb-2 border-b-2 font-medium text-indigo-500">{{ __('profile.templates.info.bio') }}</div>
            <div class="text-sm">{{ empty($user->about) ? __('profile.templates.info.about.default') : strip_tags($user->about) }}</div>
        </div>
        <div class="p-4 rounded-lg bg-white border-2 border-gray-200 shadow-sm space-y-4">
            <div class="pb-2 border-b-2 font-medium text-indigo-500">{{ __('profile.templates.info.informasi') }}</div>
            <div class="text-sm space-y-2">
                <div class="flex items-center">
                    <div class="font-medium">{{ __('profile.username') }}</div>
                    <div class="ml-auto">{{ $user->username }}</div>
                </div>
                <div class="flex items-center">
                    <div class="font-medium">{{ __('profile.templates.info.register') }}</div>
                    <div class="ml-auto">{{ date_format($user->created_at, 'd F Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
