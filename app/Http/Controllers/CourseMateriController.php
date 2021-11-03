<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseBab;
use App\Models\CourseMateri;
use App\Models\DaftarCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CourseMateriController extends Controller
{
    private function createSlug($name)
    {
        $slug = Str::slug($name);

        if (CourseMateri::where('slug', $slug)->exists()) {
            $count = CourseMateri::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $slug = $slug.'-'.$count;
        }

        return $slug;
    }

    public function create(Course $course, courseBab $courseBab)
    {
        $checkOrder = CourseMateri::where('bab_id', $courseBab->id)->latest('order')->first();
        if (!empty($checkOrder))
        {
            $lastOrder = $checkOrder->order + 1;
        }
        else
        {
            $lastOrder = 1;
        }

        return view('courses.materi.create', [
            'page_title' => 'Materi Baru - ' . $courseBab->name . ' - ' . $course->name,
            'course' => $course,
            'babs' => CourseBab::where('course_id', $course->id)->orderBy('order', 'asc')->get(),
            'courseBab' => $courseBab,
            'lastOrder' => $lastOrder,
            'file_maxSize' => min(ini_get('post_max_size'), ini_get('upload_max_filesize')) . 'B',
            'file_types' => Str::upper('csv, doc, docx, pdf, pps, ppsx, ppt, pptx, rar, txt, xls, xlsx, zip'),
        ]);
    }

    public function store(Request $request, Course $course, CourseBab $courseBab)
    {
        $file_maxSize = min((int)ini_get('post_max_size'), (int)ini_get('upload_max_filesize')) * 1024;

        $request->validate([
            'judul' => 'required|string|max:255',
            'urutan' => 'nullable|numeric|min:1|digits_between:1,2',
            'materi' => 'required|string|max:15000',
            'uploadFiles' => 'nullable',
            'uploadFiles.*' => 'mimes:csv,doc,docx,pdf,pps,ppsx,ppt,pptx,rar,txt,xls,xlsx,zip|max:'.$file_maxSize,
        ]);

        DB::transaction(function () use ($request, $course, $courseBab) {
            $slug = $this->createSlug($request->judul);

            if($request->hasfile('uploadFiles'))
            {
                $i = 0;
                $data = [];
                $path = public_path('uploads/courses/'.$course->slug.'/'.$courseBab->slug.'/'.$slug);
                foreach($request->file('uploadFiles') as $file)
                {
                    $name = 'file_' . $i . '.' . $file->extension();
                    $file->move($path, $name);
                    $data[] = $name;
                    $i++;
                }
            }
            else
            {
                $data = null;
            }

            CourseMateri::create([
                'bab_id' => $courseBab->id,
                'name' => $request->judul,
                'slug' => $slug,
                'order' => $request->urutan,
                'content' => $request->materi,
                'files' => $data,
            ]);
        });

        Alert::toast('Materi baru berhasil dibuat', 'success');
        return redirect()->route('bab_edit', [$course->slug, $courseBab->slug]);
    }

    public function show(Course $course, CourseBab $courseBab, CourseMateri $courseMateri)
    {
        if (empty(DaftarCourse::where('user_id', Auth::user()->id)->first()) && Auth::user()->id != $course->author_id && !in_array(Auth::user()->role_id, [1,2]))
        {
            Alert::toast('Anda belum terdaftar pada kursus ini!', 'error');
            return redirect()->route('course_show', $course->slug);
        }

        $listBab = CourseBab::where('course_id', $course->id)->orderBy('order', 'asc')->get();
        $listMateri = [];
        foreach ($listBab as $key => $bab)
        {
            $listMateri[] = CourseMateri::where('bab_id', $listBab[$key]->id)->orderBy('order', 'asc')->get();
        }

        return view('courses.materi.show', [
            'page_title' => $courseMateri->name . ' - ' . $courseBab->name . ' - ' . $course->name,
            'course' => $course,
            'courseBab' => $courseBab,
            'courseMateri' => $courseMateri,
            'materiFiles' => $courseMateri->files,
            'listBab' => $listBab,
            'listMateri' => $listMateri,
        ]);
    }

    public function edit(Course $course, CourseBab $courseBab, CourseMateri $courseMateri)
    {
        return view('courses.materi.edit', [
            'page_title' => 'Pembaruan ' . $courseMateri->name . ' - ' . $courseBab->name . ' - ' . $course->name,
            'course' => $course,
            'courseBab' => $courseBab,
            'courseMateri' => $courseMateri,
            'babs' => CourseBab::where('course_id', $course->id)->orderBy('order', 'asc')->get(),
            'materiFiles' => $courseMateri->files,
            'file_maxSize' => min(ini_get('post_max_size'), ini_get('upload_max_filesize')) . 'B',
            'file_types' => Str::upper('csv, doc, docx, pdf, pps, ppsx, ppt, pptx, rar, txt, xls, xlsx, zip'),
        ]);
    }

    public function update(Request $request, Course $course, CourseBab $courseBab, CourseMateri $courseMateri)
    {
        $file_maxSize = min((int)ini_get('post_max_size'), (int)ini_get('upload_max_filesize')) * 1024;

        $request->validate([
            'bab' => 'required|numeric|exists:course_babs,id',
            'judul' => 'required|string|max:255',
            'urutan' => 'nullable|numeric|min:1|digits_between:1,2',
            'materi' => 'required|string|max:15000',
            'uploadFiles' => 'nullable',
            'uploadFiles.*' => 'mimes:csv,doc,docx,pdf,pps,ppsx,ppt,pptx,rar,txt,xls,xlsx,zip|max:'.$file_maxSize,
        ]);

        DB::transaction(function () use ($request, $course, $courseBab, $courseMateri) {
            if($request->hasfile('uploadFiles'))
            {
                if ($courseMateri->files != null)
                {
                    $i = count($courseMateri->files);
                }
                else
                {
                    $i = 0;
                }

                $data = $courseMateri->files;
                $path = public_path('uploads/courses/'.$course->slug.'/'.$courseBab->slug.'/'.$courseMateri->slug);
                foreach($request->file('uploadFiles') as $file)
                {
                    $name = 'file_' . $i . '.' . $file->extension();
                    $file->move($path, $name);
                    $data[] = $name;
                    $i++;
                }
            }
            else
            {
                $data = $courseMateri->files;
            }

            CourseMateri::find($courseMateri->id)
                ->update([
                    'bab_id' => $request->bab,
                    'name' => $request->judul,
                    'order' => $request->urutan,
                    'content' => $request->materi,
                    'files' => $data,
                ]);
        });

        Alert::toast('Materi berhasil diperbarui', 'success');
        return redirect()->route('materi_edit', [$course->slug, $courseBab->slug, $courseMateri->slug]);
    }

    public function destroy(Course $course, CourseBab $courseBab, CourseMateri $courseMateri)
    {
        if ($course->author_id == Auth::user()->id || in_array(Auth::user()->role_id, [1,2]))
        {
            $path = public_path('uploads/courses/'.$course->slug.'/'.$courseBab->slug.'/'.$courseMateri->slug);
            if (File::exists($path))
            {
                File::deleteDirectory($path);
            }

            CourseMateri::destroy($courseMateri->id);

            Alert::toast('Materi berhasil dihapus', 'success');
            return redirect()->route('bab_edit', [$course->slug, $courseBab->slug]);
        }

        Alert::toast('Anda tidak mempunyai wewenang untuk menghapus materi ini', 'error');
        return redirect()->route('materi_edit', [$course->slug, $courseBab->slug, $courseMateri->slug]);
    }

    public function hapusberkas(Course $course, CourseBab $courseBab, CourseMateri $courseMateri, $fileID)
    {
        if ($course->author_id == Auth::user()->id || in_array(Auth::user()->role_id, [1,2]))
        {
            $file_path = public_path('uploads/courses/'.$course->slug.'/'.$courseBab->slug.'/'.$courseMateri->slug.'/'.$courseMateri->files[$fileID]);
            if (File::exists($file_path))
            {
                File::delete($file_path);
            }

            $files = $courseMateri->files;
            array_splice($files, $fileID, 1);

            CourseMateri::find($courseMateri->id)->update([
                'files' => $files,
            ]);

            Alert::toast('Berkas berhasil dihapus', 'success');
            return redirect()->route('materi_edit', [$course->slug, $courseBab->slug, $courseMateri->slug]);
        }

        Alert::toast('Anda tidak mempunyai wewenang untuk menghapus berkas pada materi ini', 'error');
        return redirect()->route('materi_edit', [$course->slug, $courseBab->slug, $courseMateri->slug]);
    }

    public function materidownload(Course $course, CourseBab $courseBab, CourseMateri $courseMateri, $fileID, $fileName)
    {
        $path = public_path('uploads/courses/'.$course->slug.'/'.$courseBab->slug.'/'.$courseMateri->slug);

        if (File::exists($path))
        {
            return response()->download($path.'/'.$courseMateri->files[$fileID], Str::studly($fileName));
        }

        Alert::toast('Tidak dapat mengunduh berkas', 'error');
        return redirect()->route('course_materi', [$course->slug, $courseBab->slug, $courseMateri->slug]);
    }
}
