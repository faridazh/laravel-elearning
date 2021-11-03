@extends('templates.main')

@section('breadcumb'){{ Breadcrumbs::render('setting-ulasan') }}@endsection

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
                                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">{{ __('profile.setting.reviews.kursus') }}</th>
                                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">{{ __('profile.setting.reviews.ulasan') }}</th>
                                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">
                                                @if(Request::input('sort') == 'bintang')
                                                    @if(Request::input('order') == 'asc')
                                                        <a href="?sort=bintang&amp;order=desc" class="text-indigo-500 transition duration-300 hover:text-indigo-500 focus:outline-none">
                                                            <div>{{ __('profile.setting.forum.created') }}</div>
                                                            <div class="text-2xs">({{ __('profile.setting.reviews.bintang') }})</div>
                                                        </a>
                                                    @elseif(Request::input('order') == 'desc')
                                                        <a href="?sort=bintang&amp;order=asc" class="text-indigo-500 transition duration-300 hover:text-indigo-500 focus:outline-none">
                                                            <div>{{ __('profile.setting.forum.created') }}</div>
                                                            <div class="text-2xs">({{ __('profile.setting.reviews.bintang') }})</div>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="?sort=bintang&amp;order=desc" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ __('profile.setting.reviews.bintang') }}</a>
                                                @endif
                                            </th>
                                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">{{ __('profile.setting.reviews.aksi') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($reviews as $review)
                                        <tr class="text-center">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-medium">
                                                    <a href="{{ route('course_review', $review->course->slug) }}" class="transition duration-300 hover:text-indigo-500 focus:outline-none">{{ $review->course->name }}</a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $review->review }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 text-yellow-500">
                                                    @for($i = 0; $i < $review->stars; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                                <form action="{{ route('setting-ulasan-destroy', $review->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-red-500 transition duration-300 hover:text-red-900 focus:outline-none">{{ __('profile.setting.reviews.hapus') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4" class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ __('profile.setting.reviews.nocontent') }}</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
