<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseBab;
use App\Models\CourseMateri;
use App\Models\DaftarCourse;
use App\Models\ForumReply;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ForumController extends Controller
{
    private function createSlug($name)
    {
        $slug = Str::slug($name);

        if (ForumThread::where('slug', $slug)->exists()) {
            $count = ForumThread::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $slug = $slug.'-'.$count;
        }

        return $slug;
    }

    private function getquote($text)
    {
        $text = strip_tags($text);

        $find = array(
            '~\r\n&nbsp;\r\n~s',
            '~\[quote=(.*?),page=(.*?),id=(.*?)\](.*?)\[/quote\]~s',
            '~\r\n~s',
        );

        $replace = array(
            '',
            '<blockquote class="text-sm">$4<div class="mt-3 italic">&mdash;<a href="?page=$2#$3" class="ml-1">$1</a></div></blockquote>',
            '<br>',
        );

        return preg_replace($find, $replace, $text);
    }

    private function checkdaftar($courseId, $userId)
    {
        $courseDaftar = false;
        if (Auth::check())
        {
            $userDaftar = DaftarCourse::where('course_id', $courseId)->where('user_id', $userId)->first();
            if ($userDaftar != null)
            {
                $courseDaftar = true;
            }
        }
        return $courseDaftar;
    }

    public function index(Course $course)
    {
        $courseDaftar = false;
        $courseFavs = false;
        if (Auth::check())
        {
            $userDaftar = DaftarCourse::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();
            if ($userDaftar != null)
            {
                $courseDaftar = true;
                $courseFavs = $userDaftar->favs;
            }
        }

        $forums = ForumThread::where('course_id', $course->id);

        return view('courses.forums.index', [
            'page_title' => 'Forum - ' . $course->name,
            'course' => $course,
            'courseDaftar' => $courseDaftar,
            'courseFavs' => $courseFavs,
            'forums' => $forums->paginate(10),
        ]);
    }

    public function create(Course $course, Request $request)
    {
        if ($this->checkdaftar($course->id, Auth::user()->id) == false && !in_array(Auth::user()->role_id, [1,2]) && $course->author_id != Auth::user()->id)
        {
            Alert::toast('Silakan daftar kursus ini untuk membuat forum', 'error');
            return redirect()->route('course_forum', $course->slug);
        }

        if (!empty($request->materi))
        {
            $materis[] = CourseMateri::where('slug', $request->materi)->get();
        }
        elseif (!empty($request->bab))
        {
            $materis[] = CourseMateri::where('bab_id', $request->bab)->get();
        }
        else
        {
            $babs = CourseBab::where('course_id', $course->id)->get();
            foreach ($babs as $bab) {
                $materis[] = CourseMateri::where('bab_id', $bab->id)->get();
            }
        }

        return view('courses.forums.create', [
            'page_title' => 'Forum Baru - ' . $course->name,
            'course' => $course,
            'request' => $request,
            'babs' => $babs ?? null,
            'materis' => $materis,
        ]);
    }

    public function store(Course $course, Request $request)
    {
        if ($this->checkdaftar($course->id, Auth::user()->id) == false && $course->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Silakan daftar kursus ini untuk membuat forum', 'error');
            return redirect()->route('course_show', $course->slug);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'materi' => 'required|exists:course_materis,id',
            'isiforum' => 'required|string|max:5000',
        ]);

        DB::transaction(function () use ($course, $request, &$slug) {
            $slug = $this->createSlug($request->judul);

            ForumThread::create([
                'course_id' => $course->id,
                'materi_id' => $request->materi,
                'author_id' => Auth::user()->id,
                'name' => Str::title($request->judul),
                'slug' => $slug,
                'content' => $request->isiforum,
            ]);
        });

        Alert::toast('Forum berhasil dibuat', 'success');
        return redirect()->route('course_forum_show', [$course->slug, $slug]);
    }

    public function show(Course $course, ForumThread $forum)
    {
        $replies = ForumReply::where('thread_id', $forum->id)->orderby('created_at', 'asc');

        return view('courses.forums.show', [
            'page_title' => $forum->name.' - Forum '.$course->name,
            'thread' => $forum,
            'courseDaftar' => $this->checkdaftar($course->id, Auth::user()->id),
            'replies' => $replies->paginate(5),
        ]);
    }

    public function reply(Course $course, ForumThread $forum, Request $request)
    {
        if ($this->checkdaftar($course->id, Auth::user()->id) == false && $course->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Silakan daftar kursus ini untuk membalas forum', 'error');
            return redirect()->route('course_show', $course->slug);
        }

        $request->validate([
            'forumreply' => 'required|string|min:15|max:5000',
        ]);

        DB::transaction(function () use ($forum, $request) {
            $text = $this->getquote($request->forumreply);

            ForumReply::create([
                'thread_id' => $forum->id,
                'author_id' => Auth::user()->id,
                'content' => $text,
            ]);

            ForumThread::where('id', $forum->id)->update([
                'replies' => $forum->balasan->count(),
            ]);
        });

        $replies = ForumReply::where('thread_id', $forum->id)->orderby('created_at', 'asc')->paginate(5);

        Alert::toast('Balasan Anda untuk forum ini berhasil disubmit', 'success');
        return redirect(route('course_forum_show', [$course->slug, $forum->slug]).'?page='.$replies->lastpage());
    }

    public function edit(Course $course, ForumThread $forum)
    {
        if ($course->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk memperbarui forum ini!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }
        elseif ((time() - strtotime($forum->created_at)) > 3600 && $course->author_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }

        return view('courses.forums.edit', [
            'page_title' => $forum->name.' - Forum '.$course->name,
            'thread' => $forum,
        ]);
    }

    public function update(Course $course, ForumThread $forum, Request $request)
    {
        if ($course->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk memperbarui forum ini!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }
        elseif ((time() - strtotime($forum->created_at)) > 3600 && $course->author_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }

        if ($forum->name != Str::title($request->judul))
        {
            $request->validate([
                'judul' => 'required|string|max:255|unique:forum_threads,name',
            ]);
        }
        elseif ((time() - strtotime($forum->created_at)) > 3600)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }

        $request->validate([
            'isiforum' => 'required|string|max:5000',
        ]);

        ForumThread::where('id', $forum->id)->update([
            'name' => Str::title($request->judul),
            'content' => $request->isiforum,
        ]);

        Alert::toast('Forum berhasil diperbarui', 'success');
        return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
    }

    public function destroy(Course $course, ForumThread $forum)
    {
        if ($course->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk memperbarui forum ini!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }
        elseif ((time() - strtotime($forum->created_at)) > 3600 && $course->author_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }

        ForumThread::where('id', $forum->id)->delete();

        Alert::toast('Forum berhasil dihapus', 'success');
        return redirect()->route('course_show', $course->slug);
    }

    public function editreply(Course $course, ForumThread $forum, ForumReply $reply)
    {
        if ($reply->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk memperbarui balasan ini!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }
        elseif ((time() - strtotime($reply->created_at)) > 3600 && $course->author_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }

        return view('courses.forums.replies.edit', [
            'page_title' => 'Perbarui Balasan - '.$forum->name.' - Forum '.$course->name,
            'thread' => $forum,
            'reply' => $reply,
        ]);
    }

    public function updatereply(Course $course, ForumThread $forum, ForumReply $reply, Request $request)
    {
        if ($reply->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk memperbarui balasan ini!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }
        elseif ((time() - strtotime($reply->created_at)) > 3600 && $course->author_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }

        $request->validate([
            'forumreply' => 'required|string|min:15|max:5000',
        ]);

        ForumReply::find($reply->id)->update([
            'content' => $request->forumreply,
        ]);

        Alert::toast('Balasan Anda berhasil diperbarui', 'success');
        return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
    }

    public function destroyreply(Course $course, ForumThread $forum, ForumReply $reply)
    {
        if ($reply->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk memperbarui balasan ini!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }
        elseif ((time() - strtotime($reply->created_at)) > 3600 && $course->author_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
        }

        DB::transaction(function () use ($forum, $reply) {
            ForumReply::find($reply->id)->delete();

            ForumThread::where('id', $forum->id)->update([
                'replies' => $forum->balasan->count(),
            ]);
        });

        Alert::toast('Balasan Anda untuk forum ini berhasil dihapus', 'success');
        return redirect()->route('course_forum_show', [$course->slug, $forum->slug]);
    }
}
