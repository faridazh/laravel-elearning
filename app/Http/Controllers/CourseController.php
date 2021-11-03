<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseBab;
use App\Models\CourseMateri;
use App\Models\DaftarCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class CourseController extends Controller
{
    private function createSlug($name)
    {
        $slug = Str::slug($name);

        if (Course::where('slug', $slug)->exists()) {
            $count = Course::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $slug = $slug.'-'.$count;
        }

        return $slug;
    }

    public function index()
    {
        return view('courses.index', [
            'page_title' => 'Course',
            'courses' => Course::orderBy('created_at', 'desc')->paginate(9),
        ]);
    }

    public function create()
    {
        return view('courses.create', [
            'page_title' => 'New Course',
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $coverWidth = 500;
        $coverHeight = 500;

        $request->validate([
            'judul' => 'required|string|max:255|unique:courses,name',
            'cover' => 'required|image',
            'deskripsi' => 'required|string|max:15000',
            'category' => 'required|numeric|exists:categories,id',
            'membership' => 'required|numeric|in:0,1',
        ]);

        DB::transaction(function () use ($request, $coverWidth, $coverHeight, &$slug)
        {
            $slug = $this->createSlug($request->judul);

            if ($request->hasfile('cover'))
            {
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

                $path = public_path('uploads/courses/'.$slug);
                if (!File::exists($path))
                {
                    File::makeDirectory($path, '0777', true);
                }

                $cover_name = 'cover_' . date('Ymdhis', time()) . '.' . $request->file('cover')->extension();
                $coverImg->save($path.'/'.$cover_name);
                $coverImg->destroy();
            }
            else
            {
                $cover_name = null;
            }

            Course::create([
                'name' => $request->judul,
                'slug' => $slug,
                'image' => $cover_name,
                'description' => $request->deskripsi,
                'category_id' => $request->category,
                'author_id' => Auth::user()->id,
                'premium' => $request->membership,
            ]);
        });

        Alert::toast('Kursus berhasil dibuat, silahkan masukkan bab & materi kursus', 'success');
        return redirect()->route('bab_create', $slug);
    }

    public function show(Course $course)
    {
        $courseBab = CourseBab::where('course_id', $course->id)->orderBy('order', 'asc')->get();

        $courseMateri = [];
        foreach ($courseBab as $key => $bab)
        {
            $courseMateri[] = CourseMateri::where('bab_id', $courseBab[$key]->id)->orderBy('order', 'asc')->get();
        }

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

        return view('courses.show', [
            'page_title' => $course->name,
            'course' => $course,
            'courseBab' => $courseBab,
            'courseMateri' => $courseMateri,
            'courseDaftar' => $courseDaftar,
            'courseFavs' => $courseFavs,
        ]);
    }

    public function edit(Course $course)
    {
        if ($course->author_id == Auth::user()->id || Auth::user()->role_id == 1)
        {
            return view('courses.edit', [
                'page_title' => 'Pembaruan ' . $course->name,
                'course' => $course,
                'categories' => Category::all(),
                'babs' => CourseBab::where('course_id', $course->id)->orderBy('order', 'asc')->get(),
            ]);
        }

        Alert::toast('Anda tidak mempunyai wewenang untuk memperbarui kursus ini', 'error');
        return redirect()->route('course_show', $course->slug);
    }

    public function update(Request $request, Course $course)
    {
        $coverWidth = 500;
        $coverHeight = 500;

        if ($request->judul != $course->name)
        {
            $request->validate([
                'judul' => 'required|string|max:255|unique:courses,name',
            ]);
        }

        $request->validate([
            'cover' => 'nullable|image',
            'description' => 'required|string|max:15000',
            'category' => 'required|numeric|exists:categories,id',
            'membership' => 'required|numeric|in:0,1',
        ]);

        DB::transaction(function () use ($course, $request, $coverWidth, $coverHeight)
        {
            if ($request->hasfile('cover'))
            {
                $path = public_path('uploads/courses/'.$course->slug);

                if (!empty($course->image))
                {
                    File::delete($path.'/'.$course->image);
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

                $cover_name = 'cover_' . date('Ymdhis', time()) . '.' . $request->file('cover')->extension();
                $coverImg->save($path.'/'.$cover_name);
                $coverImg->destroy();
            }
            else
            {
                $cover_name = $course->image;
            }

            Course::where('id', $course->id)
                    ->update(
                        [
                            'name' => $request->judul,
                            'image' => $cover_name,
                            'description' => $request->description,
                            'category_id' => $request->category,
                            'premium' => $request->membership,
                        ]
                    );
        });

        Alert::toast('Halaman utama kursus berhasil diperbarui', 'success');
        return redirect()->route('course_edit', $course->slug);
    }

    public function destroy(Course $course)
    {
        if ($course->author_id == Auth::user()->id || in_array(Auth::user()->role_id, [1,2]))
        {
            $path = public_path('uploads/courses/'.$course->slug);
            if (File::exists($path))
            {
                File::deleteDirectory($path);
            }

            Course::destroy($course->id);

            Alert::toast('Kursus berhasil dihapus', 'success');
            return redirect()->route('courses');
        }

        Alert::toast('Anda tidak mempunyai wewenang untuk menghapus kursus ini', 'error');
        return redirect()->route('course_show', $course->slug);
    }

    public function favscourse(Course $course)
    {
        $registered = DaftarCourse::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();

        if ($registered != null)
        {
            if ($registered->favs == false)
            {
                DB::transaction(function () use ($course) {
                    DaftarCourse::where('course_id', $course->id)->where('user_id', Auth::user()->id)->update([
                        'favs' => true,
                    ]);

                    $likes = intval($course->likes + 1);
                    Course::where('id', $course->id)->update([
                        'likes' => $likes,
                    ]);
                });

                Alert::toast('Berhasil ditambahkan ke dalam kursus favorit Anda', 'success');
            }
            elseif ($registered->favs == true)
            {
                DB::transaction(function () use ($course) {
                    DaftarCourse::where('course_id', $course->id)->where('user_id', Auth::user()->id)->update([
                        'favs' => false,
                    ]);

                    $likes = intval($course->likes - 1);
                    Course::where('id', $course->id)->update([
                        'likes' => $likes,
                    ]);
                });

                Alert::toast('Berhasil dihapus dari kursus favorit Anda', 'success');
            }
            else
            {
                Alert::toast('Terjadi error, silahkan hubungi staff', 'error');
                return redirect()->route('course_show', $course->slug);
            }

            return redirect()->route('course_show', $course->slug);
        }

        Alert::toast('Terjadi error, silahkan hubungi staff', 'error');
        return redirect()->route('course_show', $course->slug);
    }
}
