<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index', [
            'page_title' => 'Free E-Learning',
            'courses' => Course::orderBy('created_at', 'desc')->limit(3)->get(),
        ]);
    }

    public function about()
    {
        return view('about', [
            'page_title' => 'Tentang'
        ]);
    }
}
