<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseReview;
use App\Models\DaftarCourse;
use App\Models\ForumReply;
use App\Models\ForumThread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $my_courses = null;

        if (in_array($user->role_id, [4,5]))
        {
            $my_courses = DaftarCourse::where('user_id', $user->id)->paginate(10);
        }
        elseif (in_array($user->role_id, [1,2,3]))
        {
            $my_courses = Course::where('author_id', $user->id)->paginate(10);
        }

        return view('user.profile', [
            'page_title' => $user->name,
            'user' => $user,
            'my_courses' => $my_courses,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $avatarWidth = 300;
        $avatarHeight = 300;

        $coverWidth = 1250;
        $coverHeight = 500;

        if ($request->username != Auth::user()->username)
        {
            $request->validate([
                'username' => 'required|alpha_num|min:5|max:25|unique:users,username',
            ]);
        }

        $request->validate([
            'avatar' => 'nullable|image',
            'cover' => 'nullable|image',
            'about' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $avatarWidth, $avatarHeight, $coverWidth, $coverHeight)
        {
            if ($request->hasfile('avatar'))
            {
                if (!empty(Auth::user()->avatar))
                {
                    File::delete(public_path('uploads/avatars/' . Auth::user()->avatar));
                }

                $img = Image::make($request->file('avatar'));

                if ($img->width() > $avatarWidth) {
                    $img->resize($avatarWidth, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                elseif ($img->height() > $avatarHeight) {
                    $img->resize(null, $avatarHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                else {
                    $img->resize($avatarWidth, $avatarHeight, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                $avatar_name = Auth::user()->id . '_' . date('Ymdhis', time()) . '.' . $request->file('avatar')->extension();
                $img->save(public_path('uploads/avatars/' . $avatar_name));
                $img->destroy();
            }
            else
            {
                $avatar_name = Auth::user()->avatar;
            }

            if ($request->hasfile('cover'))
            {
                if (!empty(Auth::user()->cover))
                {
                    File::delete(public_path('uploads/covers/' . Auth::user()->cover));
                }

                $coverImg = Image::make($request->file('cover'));

                if ($coverImg->width() > $coverWidth) {
                    $coverImg->resize($coverWidth, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                elseif ($coverImg->height() > $coverHeight) {
                    $coverImg->resize(null, $coverHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                else {
                    $coverImg->resize($coverWidth, $coverHeight, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                $cover_name = Auth::user()->id . '_' . date('Ymdhis', time()) . '.' . $request->file('cover')->extension();
                $coverImg->save(public_path('uploads/covers/' . $cover_name));
                $coverImg->destroy();
            }
            else
            {
                $cover_name = Auth::user()->cover;
            }

            User::where('id', Auth::user()->id)
                ->update([
                    'username' => $request->username,
                    'avatar' => $avatar_name,
                    'cover' => $cover_name,
                    'about' => $request->about,
                ]);
        });

        return redirect()->route('setting-account');
    }

    public function reviews(User $user)
    {
        if ($user->id == Auth::user()->id && in_array($user->role_id, [4,5]))
        {
            $reviews = CourseReview::where('user_id', $user->id)->orderby('created_at', 'desc');
        }
        elseif ($user->id != Auth::user()->id && in_array($user->role_id, [4,5]))
        {
            $reviews = CourseReview::where('user_id', $user->id)->where('hidename', false)->orderby('created_at', 'desc');
        }
        elseif (in_array($user->role_id, [1,2,3]))
        {
            $reviews = CourseReview::where('author_id', $user->id)->orderby('created_at', 'desc');
        }

        return view('user.profile.reviews', [
            'page_title' => 'Ulasan - ' . $user->name,
            'user' => $user,
            'reviews' => $reviews->paginate(6),
        ]);
    }

    public function forums(User $user)
    {
        $forums = ForumThread::where('author_id', $user->id);

        return view('user.profile.forum', [
            'page_title' => 'Forum - ' . $user->name,
            'user' => $user,
            'forums' => $forums->paginate(6),
        ]);
    }

    public function setting_account()
    {
        return view('user.settings.account', [
            'page_title' => 'Pengaturan Profil',
        ]);
    }

    public function setting_private()
    {
        return view('user.settings.private', [
            'page_title' => 'Pengaturan Data Pribadi',
        ]);
    }

    public function setting_password()
    {
        return view('user.settings.password', [
            'page_title' => 'Pengaturan Password',
        ]);
    }

    public function setting_ulasan(Request $request)
    {
        $reviews = CourseReview::where('user_id', Auth::user()->id);

        if ($request->has('sort') && $request->has('order') && in_array($request->order, ['asc', 'desc']))
        {
            if ($request->sort == 'bintang')
            {
                $reviews == $reviews->orderby('stars', $request->order);
            }
        }
        else
        {
            $reviews == $reviews->orderby('created_at', 'desc');
        }

        return view('user.settings.reviews', [
            'page_title' => 'Pengaturan Ulasan',
            'reviews' => $reviews->paginate(20),
        ]);
    }

    public function setting_ulasan_destroy(CourseReview $ulasan)
    {
        if ($ulasan->user_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk menghapus ulasan!', 'error');
            return redirect()->route('setting-ulasan');
        }
        elseif ((time() - strtotime($ulasan->created_at)) > 3600 && $ulasan->user_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('setting-ulasan');
        }

        CourseReview::find($ulasan->id)->delete();

        Alert::toast('Ulasan berhasil dihapus', 'success');
        return redirect()->route('setting-ulasan');
    }

    public function setting_forum(Request $request)
    {
        $forums = ForumThread::where('author_id', Auth::user()->id);

        if ($request->has('sort') && $request->has('order') && in_array($request->order, ['asc', 'desc']))
        {
            if ($request->sort == 'forum')
            {
                $forums == $forums->orderby('name', $request->order);
            }
            elseif ($request->sort == 'kursus')
            {
                $forums == $forums->orderby('course_id', $request->order);
            }
            elseif ($request->sort == 'tanggal')
            {
                $forums == $forums->orderby('created_at', $request->order);
            }
        }
        else
        {
            $forums == $forums->orderby('created_at', 'desc');
        }

        return view('user.settings.forums', [
            'page_title' => 'Pengaturan Forum',
            'forums' => $forums->paginate(20),
        ]);
    }

    public function setting_forum_destroy(ForumThread $forum)
    {
        if ($forum->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk memperbarui forum!', 'error');
            return redirect()->route('setting-forum');
        }
        elseif ((time() - strtotime($forum->created_at)) > 3600 && $forum->author_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('setting-forum');
        }

        ForumThread::find($forum->id)->delete();

        Alert::toast('Forum berhasil dihapus', 'success');
        return redirect()->route('setting-forum');
    }

    public function setting_balasan(Request $request)
    {
        $replies = ForumReply::where('author_id', Auth::user()->id);

        if ($request->has('sort') && $request->has('order') && in_array($request->order, ['asc', 'desc']))
        {
            if ($request->sort == 'forum')
            {
                $replies == $replies->orderby('thread_id', $request->order);
            }
            elseif ($request->sort == 'tanggal')
            {
                $replies == $replies->orderby('created_at', $request->order);
            }
        }
        else
        {
            $replies == $replies->orderby('created_at', 'desc');
        }

        return view('user.settings.replies', [
            'page_title' => 'Pengaturan Balasan Forum',
            'replies' => $replies->paginate(20),
        ]);
    }

    public function setting_balasan_destroy(ForumReply $reply)
    {
        if ($reply->author_id != Auth::user()->id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda tidak punya wewenang untuk memperbarui balasan!', 'error');
            return redirect()->route('setting-balasan');
        }
        elseif ((time() - strtotime($reply->created_at)) > 3600 && $reply->author_id == Auth::user()->id)
        {
            Alert::toast('Sudah melebihi batas masa perubahan!', 'error');
            return redirect()->route('setting-balasan');
        }

        DB::transaction(function () use ($reply) {
            ForumReply::find($reply->id)->delete();

            ForumThread::where('id', $reply->thread->id)->update([
                'replies' => $reply->thread->balasan->count(),
            ]);
        });

        Alert::toast('Balasan Anda berhasil dihapus', 'success');
        return redirect()->route('setting-balasan');
    }
}
