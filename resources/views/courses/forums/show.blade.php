@extends('templates.main')



@section('content')
    <section class="bg-white">
        <div class="max-w-3xl mx-auto lg:max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center space-y-3">
                <div class="font-semibold text-3xl">{{ $thread->name }}</div>
                <div class="font-medium">
                    <a href="{{ route('course_show', $thread->course->slug) }}" class="hover:text-indigo-500 focus:text-indigo-700 focus:outline-none">{{ $thread->course->name }}</a>&nbsp;-&nbsp;<a href="{{ route('course_materi', [$thread->course->slug, $thread->materi->bab->slug, $thread->materi->slug]) }}" class="hover:text-indigo-500 focus:text-indigo-700 focus:outline-none">{{ $thread->materi->name }}</a>
                </div>
            </div>
            <div class="space-y-5">
                <div class="border-2 border-indigo-200 rounded-lg divide-y-2 divide-indigo-200" id="0">
                    <div class="flex items-center p-5">
                        <img src="{{ asset('uploads/avatars/'.$thread->author->avatar) }}" alt="" class="max-h-16 mr-5 rounded-full border-2 border-gray-200" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                        <div>
                            <div class="text-xl font-medium">
                                <a href="{{ route('profile', $thread->author->username) }}" target="_blank" class="hover:text-indigo-500 focus:text-indigo-700 focus:outline-none">{{ $thread->author->name }}</a>
                            </div>
                            <div class="inline-block px-2 py-1 rounded text-2xs font-medium shadow tracking-wide uppercase" style="background: {{ $thread->author->role->bg_color }}; color: {{ $thread->author->role->text_color }};"><i class="fas {{ 'fa-' . $thread->author->role->icon }} mr-1"></i>{{ $thread->author->role->name }}</div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center px-5 py-2">
                        <div class="text-sm"><i class="fas @if($thread->updated_at != $thread->created_at) fa-edit @else fa-clock @endif mr-1"></i>{{ date_format($thread->updated_at, 'd F Y') }}</div>
                        <a href="#0" class="text-sm hover:text-indigo-500 focus:text-indigo-900 focus:outline-none">#0</a>
                    </div>
                    <article class="p-5" id="content-0">{!! $thread->content !!}</article>
                    <div class="px-5 py-3 flex justify-between items-center">
                        <div class="space-x-1">
                            <a href="{{ 'https://www.facebook.com/sharer/sharer.php?u='.url()->current() }}" target="_blank" class="px-2 py-1 rounded bg-gray-200 text-sm font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fab fa-facebook fa-fw"></i></a>
                            <a href="{{ 'https://twitter.com/intent/tweet?text='.$thread->name.'&amp;url='.url()->current() }}" target="_blank" class="px-2 py-1 rounded bg-gray-200 text-sm font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fab fa-twitter fa-fw"></i></a>
                            <a href="{{ 'https://wa.me/?text=*'.$thread->name.'*%0A'.url()->current() }}" target="_blank" class="px-2 py-1 rounded bg-gray-200 text-sm font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fab fa-whatsapp fa-fw"></i></a>
                        </div>
                        <div class="space-x-1">
                            @if((time() - strtotime($thread->created_at)) < 3600 && $thread->author_id == Auth::user()->id || in_array(Auth::user()->role_id, [1,2]))
                                <a href="{{ route('course_forum_edit_thread', [$thread->course->slug, $thread->slug]) }}" class="px-2 py-1 rounded bg-gray-200 text-xs font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fas fa-edit mr-1"></i>{{ __('course.perbarui') }}</a>
                            @endif
                            <button type="button" onclick="quoteBtn('{{ $thread->author->name }}','{{ Request::input('page') }}','0','content-0')" class="px-2 py-1 rounded bg-gray-200 text-xs font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fas fa-reply mr-1"></i>{{ __('course.forum.show.balas') }}</button>
                            <button type="button" class="px-2 py-1 rounded bg-gray-200 text-xs font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fas fa-exclamation-circle mr-1"></i>{{ __('course.materi.laporkan') }}</button>
                        </div>
                    </div>
                </div>
                @if($courseDaftar == true || $thread->course->author_id == Auth::user()->id || in_array(Auth::user()->role_id, [1,2]))
                    @foreach($replies as $key => $reply)
                        <div class="border-2 border-gray-200 rounded-lg divide-y-2" id="{{ $reply->id }}">
                            <div class="flex items-center p-5">
                                <img src="{{ asset('uploads/avatars/'.$reply->author->avatar) }}" alt="" class="max-h-16 mr-5 rounded-full border-2 border-gray-200" onerror="this.src='{{ asset('images/default_avatar.png') }}'">
                                <div>
                                    <div class="text-xl font-medium">
                                        <a href="{{ route('profile', $reply->author->username) }}" target="_blank" class="hover:text-indigo-500 focus:text-indigo-700 focus:outline-none">{{ $reply->author->name }}</a>
                                    </div>
                                    <div class="inline-block px-2 py-1 rounded text-2xs font-medium shadow tracking-wide uppercase" style="background: {{ $reply->author->role->bg_color }}; color: {{ $reply->author->role->text_color }};"><i class="fas {{ 'fa-' . $reply->author->role->icon }} mr-1"></i>{{ $reply->author->role->name }}</div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center px-5 py-2">
                                <div class="text-sm"><i class="fas @if($reply->updated_at != $reply->created_at) fa-edit @else fa-clock @endif mr-1"></i>{{ date_format($reply->updated_at, 'd F Y') }}</div>
                                <a href="#{{ $reply->id }}" class="text-sm hover:text-indigo-500 focus:text-indigo-900 focus:outline-none">#{{ $key + 1 + ($replies->currentPage()-1) * $replies->perPage() }}</a>
                            </div>
                            <article class="p-5" id="{{ 'content-'.$reply->id }}">{!! $reply->content !!}</article>
                            <div class="px-5 py-3 flex justify-between items-center">
                                <div class="space-x-1">
                                    <a href="{{ 'https://www.facebook.com/sharer/sharer.php?u='.url()->current() }}" target="_blank" class="px-2 py-1 rounded bg-gray-200 text-sm font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fab fa-facebook fa-fw"></i></a>
                                    <a href="{{ 'https://twitter.com/intent/tweet?text='.$thread->name.'&amp;url='.url()->current() }}" target="_blank" class="px-2 py-1 rounded bg-gray-200 text-sm font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fab fa-twitter fa-fw"></i></a>
                                    <a href="{{ 'https://wa.me/?text=*'.$thread->name.'*%0A'.url()->current() }}" target="_blank" class="px-2 py-1 rounded bg-gray-200 text-sm font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fab fa-whatsapp fa-fw"></i></a>
                                </div>
                                <div class="space-x-1">
                                    @if((time() - strtotime($reply->created_at) < 3600) && $reply->author_id == Auth::user()->id || in_array(Auth::user()->role_id, [1,2]))
                                        <a href="{{ route('course_forum_edit_reply', [$thread->course->slug, $thread->slug, $reply->id]) }}" class="px-2 py-1 rounded bg-gray-200 text-xs font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fas fa-edit mr-1"></i>{{ __('course.perbarui') }}</a>
                                    @endif
                                    <button type="button" onclick="quoteBtn('{{ $reply->author->name }}','{{ Request::input('page') }}','{{ $reply->id }}','{{ 'content-'.$reply->id }}')" class="px-2 py-1 rounded bg-gray-200 text-xs font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fas fa-reply mr-1"></i>{{ __('course.forum.show.balas') }}</button>
                                    <button type="button" class="px-2 py-1 rounded bg-gray-200 text-xs font-medium ring-2 ring-transparent transition duration-300 hover:bg-gray-300 focus:ring-gray-400 focus:outline-none"><i class="fas fa-exclamation-circle mr-1"></i>{{ __('course.materi.laporkan') }}</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="border-2 border-gray-200 rounded-lg p-5">
                        <form action="{{ route('daftar_kursus', $thread->course->slug) }}" method="post" class="w-full">
                            @csrf
                            <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">{{ __('course.sidebar.daftar') }}</button>
                        </form>
                    </div>
                @endif
            </div>
            @if($courseDaftar == true || $thread->course->author_id == Auth::user()->id || in_array(Auth::user()->role_id, [1,2]))
                <div class="mt-5">
                    {{ $replies->links() }}
                </div>
                <div class="mt-5">
                    <form action="{{ route('course_forum_reply', [$thread->course->slug, $thread->slug]) }}" method="post">
                        @csrf
                        <div class="max-w-full">
                            <textarea name="forumreply" id="forumreply" rows="5" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none ckeditor @error('forumreply') border-red-400 @enderror" placeholder="{{ __('course.forum.show.reply.content') }}...">{{ old('forumreply') }}</textarea>
                            @error('forumreply')
                            <div class="mt-1 text-sm text-red-700">
                                <div>*{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                        <div class="mt-5 flex items-center justify-end">
                            <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none"><i class="fas fa-reply mr-2"></i>{{ __('course.forum.show.reply.button') }}</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </section>
    <script>
        function quoteBtn(author,page,id,text) {
            if (page == '') {
                page = 1;
            }
            var content = document.getElementById(text).innerHTML;
            document.getElementById('forumreply').value += '[quote='+author+',page='+page+',id='+id+']' + content + '[/quote]\r\n';

            var ele = document.getElementById('forumreply');
            window.scrollTo(ele.offsetLeft,ele.offsetTop);
        }
    </script>
@endsection
