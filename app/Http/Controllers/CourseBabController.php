<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseBab;
use App\Models\CourseMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CourseBabController extends Controller
{
    private function createSlug($name)
    {
        $slug = Str::slug($name);

        if (CourseBab::where('slug', $slug)->exists()) {
            $count = CourseBab::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $slug = $slug.'-'.$count;
        }

        return $slug;
    }

    public function create(Course $course)
    {
        $checkOrder = CourseBab::where('course_id', $course->id)->latest('order')->first();
        if (!empty($checkOrder))
        {
            $lastOrder = $checkOrder->order + 1;
        }
        else
        {
            $lastOrder = 1;
        }

        return view('courses.bab.create', [
            'page_title' => 'Bab Baru - ' . $course->name,
            'course' => $course,
            'babs' => CourseBab::where('course_id', $course->id)->orderBy('order', 'asc')->get(),
            'lastOrder' => $lastOrder,
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'urutan' => 'nullable|numeric|min:1|digits_between:1,2',
        ]);

        $slug = $this->createSlug($request->judul);

        CourseBab::create([
            'course_id' => $course->id,
            'name' => $request->judul,
            'slug' => $slug,
            'order' => $request->urutan,
        ]);

        $bab = CourseBab::where('course_id', $course->id)->latest('id')->first();

        Alert::toast('Bab berhasil ditambahkan', 'success');
        return redirect()->route('bab_edit', [$course->slug, $bab->slug]);
    }

    public function edit(Course $course, CourseBab $courseBab)
    {
        return view('courses.bab.edit', [
            'page_title' => 'Pembaruan ' . $courseBab->name .' - ' . $course->name,
            'course' => $course,
            'babs' => CourseBab::where('course_id', $course->id)->orderBy('order', 'asc')->get(),
            'courseBab' => $courseBab,
            'courseMateri' => CourseMateri::where('bab_id', $courseBab->id)->orderBy('order', 'asc')->get(),
        ]);
    }

    public function update(Request $request, Course $course, CourseBab $courseBab)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'urutan' => 'nullable|numeric|min:1|digits_between:1,2',
        ]);

        CourseBab::where('id', $courseBab->id)
                    ->update([
                        'name' => $request->judul,
                        'order' => $request->urutan,
                    ]);

        Alert::toast('Bab berhasil diperbarui', 'success');
        return redirect()->route('bab_edit', [$course->slug, $courseBab->slug]);
    }

    public function destroy(Course $course, CourseBab $courseBab)
    {
        if ($course->author_id == Auth::user()->id || Auth::user()->role_id == 1)
        {
            $path = public_path('/uploads/courses/'.$course->slug.'/'.$courseBab->slug);
            if (File::exists($path))
            {
                File::deleteDirectory($path);
            }

            CourseBab::destroy($courseBab->id);

            Alert::toast('Bab berhasil dihapus', 'success');
            return redirect()->route('bab_create', $course->slug);
        }

        Alert::toast('Anda tidak mempunyai wewenang untuk melakukan penghapusan', 'error');
        return redirect()->route('course_show', $course->slug);
    }
}
