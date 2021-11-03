<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseBab;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CKEditorController extends Controller
{
    public function upload_desc_image(Request $request)
    {
        if($request->hasFile('upload')) {
            $imageWidth = 1000;
            $imageHeight = 1000;

            $img = Image::make($request->file('upload'));

            if ($img->width() > $imageWidth) {
                $img->resize($imageWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            elseif ($img->height() > $imageHeight) {
                $img->resize(null, $imageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            else {
                $img->resize($imageWidth, $imageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $imageName = 'desc_' . date('Ymdhis', time()) . '.' . $request->file('upload')->extension();
            $img->save(public_path('uploads/courses/ckimages/'.$imageName));
            $img->destroy();

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('/uploads/courses/ckimages/'.$imageName);

            $msg = 'Gambar berhasil diunggah';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function upload_materi_image(Request $request, Course $course, CourseBab $courseBab)
    {
        if($request->hasFile('upload')) {
            $imageWidth = 1000;
            $imageHeight = 1000;

            $img = Image::make($request->file('upload'));

            if ($img->width() > $imageWidth) {
                $img->resize($imageWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            elseif ($img->height() > $imageHeight) {
                $img->resize(null, $imageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            else {
                $img->resize($imageWidth, $imageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $imageName = 'materi_' . date('Ymdhis', time()) . '.' . $request->file('upload')->extension();
            $img->save(public_path('uploads/courses/ckimages/'.$imageName));
            $img->destroy();

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('/uploads/courses/ckimages/'.$imageName);

            $msg = 'Gambar berhasil diunggah';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
