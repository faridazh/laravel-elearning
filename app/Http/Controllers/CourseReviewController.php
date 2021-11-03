<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseReview;
use App\Models\DaftarCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CourseReviewController extends Controller
{
    public function index(Course $course, Request $request)
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

        $courseReviewed = false;
        if (Auth::check())
        {
            $reviewed = CourseReview::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();
            if (Auth::check() && $reviewed != null)
            {
                $courseReviewed = true;
            }
        }

        $courseReviews = CourseReview::where('course_id', $course->id)->orderby('created_at', 'desc');
        if ($request->has('bintang'))
        {
            if (is_numeric($request->bintang))
            {
                $courseReviews = $courseReviews->where('stars', $request->bintang);
            }
        }

        return view('courses.reviews.index', [
            'page_title' => 'Reviews - ' . $course->name,
            'course' => $course,
            'courseDaftar' => $courseDaftar,
            'courseFavs' => $courseFavs,
            'courseReviews' => $courseReviews->paginate(6),
            'courseReviewed' => $courseReviewed,
        ]);
    }

    public function store(Course $course, Request $request)
    {
        $userReview = CourseReview::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();
        if ($userReview == null)
        {
            $request->validate([
                'bintangUlasan' => 'required|in:1,2,3,4,5',
                'ulasanKursus' => 'required|min:10|max:255',
            ]);

            $hideName = false;
            if ($request->nameHide == true)
            {
                $hideName = true;
            }

            CourseReview::create([
                'course_id' => $course->id,
                'author_id' => $course->author_id,
                'user_id' => Auth::user()->id,
                'stars' => $request->bintangUlasan,
                'review' => $request->ulasanKursus,
                'hidename' => $hideName,
            ]);

            Alert::toast('Anda berhasil memberikan ulasan untuk kursus ini', 'success');
        }
        else
        {
            Alert::toast('Anda sudah memberikan ulasan untuk kursus ini', 'info');
        }

        return redirect()->route('course_review', $course->slug);
    }
}
