<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DaftarCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DaftarCourseController extends Controller
{
    public function daftar(Course $course)
    {
        DB::transaction(function () use ($course) {
            DaftarCourse::create([
                'course_id' => $course->id,
                'user_id' => Auth::user()->id,
            ]);

            $reads = intval($course->reads + 1);
            Course::where('id', $course->id)->update([
                'reads' => $reads,
            ]);
        });

        Alert::toast('Selamat, Anda berhasil mendaftar kursus ini!', 'success');
        return redirect()->route('course_show', $course->slug);
    }
}
