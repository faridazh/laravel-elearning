@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('setting-balasan') }}@endsection

@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 lg:gap-8 items-start">
                @include('user.settings.nav')
                <div class="lg:col-span-3">
                    <div class="flex flex-col mb-5">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow-sm overflow-hidden border-2 border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y-2 divide-gray-200">
                                        <thead class="bg-gray-100">
                                        <tr class="text-center">
                                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">
                                                @if(Request::input('sort') == 'forum')
                                                    @if(Request::input('order') == 'asc')
                                                        <a href="?sort=forum&amp;order=desc" class="text-indigo-500 transition duration-300 hover:text-indigo-500 focus:outline-none">
                                                            <div>{{ __('profile.setting.forum.forum') }}</div>
                                                            <div class="text-2xs">({{ __('profile.setting.forum.asc') }})</div>
                                                        </a>
                                                    @elseif(Request::input('order') == 'desc')
                                                        <a href="?sort=forum&amp;order=asc" class="text-indigo-500 transition duration-300 hover:text-indigo-500 focus:outline-none">
                                                            <div>{{ __('profile.setting.forum.forum') }}</div>
                                                            <div class="text-2xs">({{ __('profile.setting.forum.desc') }})</div>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="?sort=forum&amp;order=desc" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ __('profile.setting.forum.forum') }}</a>
                                                @endif
                                            </th>
                                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">{{ __('profile.setting.reply.balasan') }}</th>
                                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">
                                                @if(Request::input('sort') == 'tanggal')
                                                    @if(Request::input('order') == 'asc')
                                                        <a href="?sort=tanggal&amp;order=desc" class="text-indigo-500 transition duration-300 hover:text-indigo-500 focus:outline-none">
                                                            <div>{{ __('profile.setting.forum.created') }}</div>
                                                            <div class="text-2xs">({{ __('profile.setting.forum.asc') }})</div>
                                                        </a>
                                                    @elseif(Request::input('order') == 'desc')
                                                        <a href="?sort=tanggal&amp;order=asc" class="text-indigo-500 transition duration-300 hover:text-indigo-500 focus:outline-none">
                                                            <div>{{ __('profile.setting.forum.created') }}</div>
                                                            <div class="text-2xs">({{ __('profile.setting.forum.desc') }})</div>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="?sort=tanggal&amp;order=desc" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ __('profile.setting.forum.created') }}</a>
                                                @endif
                                            </th>
                                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">{{ __('profile.setting.forum.aksi') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($replies as $reply)
                                            <tr class="text-center">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 font-medium">
                                                        <a href="{{ route('course_forum_show', [$reply->thread->course->slug, $reply->thread->slug]) }}" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ $reply->thread->name }}</a>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap space-y-1">
                                                    <div class="text-sm">{{ Str::limit(html_entity_decode(strip_tags($reply->content)), 100) }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ date_format($reply->created_at, 'd M Y') }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                                    <form action="{{ route('setting-balasan-destroy', $reply->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="font-medium text-red-500 transition duration-300 hover:text-red-800 focus:outline-none">{{ __('profile.setting.forum.hapus') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4" class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ __('profile.setting.forum.nocontent') }}</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $replies->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
