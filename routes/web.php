<?php

use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\CourseBabController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseMateriController;
use App\Http\Controllers\CourseReviewController;
use App\Http\Controllers\DaftarCourseController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/fortify.php';

Route::group(['middleware' => 'auth', 'prefix' => '/profil'], function () {
    Route::get('/{user}', [ProfileController::class, 'index'])->name('profile');
    Route::get('/{user}/forum', [ProfileController::class, 'forums'])->name('profile_forums');
    Route::get('/{user}/ulasan', [ProfileController::class, 'reviews'])->name('profile_reviews');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/user/pengaturan', function () {
        return redirect()->route('setting-account');
    })->name('setting');

    Route::group(['prefix' => '/user/pengaturan'], function () {
        Route::get('/profil', [ProfileController::class, 'setting_account'])->name('setting-account');
        Route::post('/profil', [ProfileController::class, 'updateProfile'])->name('updateProfile');

        Route::get('/pribadi', [ProfileController::class, 'setting_private'])->name('setting-private');
        Route::get('/password', [ProfileController::class, 'setting_password'])->name('setting-password');

        Route::get('/forum', [ProfileController::class, 'setting_forum'])->name('setting-forum');
        Route::delete('/forum/{forum}/hapus', [ProfileController::class, 'setting_forum_destroy'])->name('setting-forum-destroy');

        Route::get('/balasan', [ProfileController::class, 'setting_balasan'])->name('setting-balasan');
        Route::delete('/balasan/{reply}/hapus', [ProfileController::class, 'setting_balasan_destroy'])->name('setting-balasan-destroy');

        Route::get('/ulasan', [ProfileController::class, 'setting_ulasan'])->name('setting-ulasan');
        Route::delete('/ulasan/{ulasan}/hapus', [ProfileController::class, 'setting_ulasan_destroy'])->name('setting-ulasan-destroy');
    });
});

Route::group(['prefix' => '/kursus'], function () {
    // Middleware == Admin, Staff, Dosen
    Route::group(['middleware' => 'role:dosen'], function () {
        Route::get('/baru', [CourseController::class, 'create'])->name('course_create');
        Route::post('/baru', [CourseController::class, 'store']);

        Route::get('/ckeditor/upload/image/kursus/deskripsi', function () { return abort(404); });
        Route::post('/ckeditor/upload/image/kursus/deskripsi', [CKEditorController::class, 'upload_desc_image'])->name('ckeditor.image-upload-course-description');

        Route::get('/{course:slug}/edit', [CourseController::class, 'edit'])->name('course_edit');
        Route::patch('/{course:slug}/edit', [CourseController::class, 'update']);

        Route::get('/{course:slug}/hapus/yakin', function () { return abort(404); });
        Route::delete('/{course:slug}/hapus/yakin', [CourseController::class, 'destroy'])->name('course_delete');

        // Bab Kursus
        Route::group(['prefix' => '/{course:slug}/bab'], function () {
            Route::get('/baru', [CourseBabController::class, 'create'])->name('bab_create');
            Route::post('/baru', [CourseBabController::class, 'store']);

            Route::get('/{courseBab}/edit', [CourseBabController::class, 'edit'])->name('bab_edit');
            Route::patch('/{courseBab}/edit', [CourseBabController::class, 'update']);

            Route::get('/{courseBab}/hapus/yakin', function () { return abort(404); });
            Route::delete('/{courseBab}/hapus/yakin', [CourseBabController::class, 'destroy'])->name('bab_delete');

            // Materi Kursus
            Route::group(['prefix' => '/{courseBab}/materi'], function () {
                Route::get('/baru', [CourseMateriController::class, 'create'])->name('materi_create');
                Route::post('/baru', [CourseMateriController::class, 'store']);

                Route::get('/{courseMateri}/edit', [CourseMateriController::class, 'edit'])->name('materi_edit');
                Route::patch('/{courseMateri}/edit', [CourseMateriController::class, 'update']);

                Route::get('/{courseMateri}/hapus/yakin', function () { return abort(404); });
                Route::delete('/{courseMateri}/hapus/yakin', [CourseMateriController::class, 'destroy'])->name('materi_delete');

                Route::get('/{courseMateri}/hapus/berkas/{file}/yakin', function () { return abort(404); });
                Route::patch('/{courseMateri}/hapus/berkas/{fileID}/yakin', [CourseMateriController::class, 'hapusberkas'])->name('berkas_delete');

                Route::get('/{courseMateri}/download/{fileID}/{fileName}', [CourseMateriController::class, 'materidownload'])->name('materi_download');
            });

            Route::get('/ckeditor/upload/image/materi/konten', function () { return abort(404); });
            Route::post('/ckeditor/upload/image/materi/konten', [CKEditorController::class, 'upload_materi_image'])->name('ckeditor.image-upload-materi');
        });
    });

    Route::group(['middleware' => ['auth', 'verified']], function () {
        // Daftar Kursus
        Route::get('/{course}/daftar', function () { return abort(404); });
        Route::post('/{course}/daftar', [DaftarCourseController::class, 'daftar'])->name('daftar_kursus');

        // Materi GET
        Route::get('/{course}/bab/{courseBab}/materi/{courseMateri}', [CourseMateriController::class, 'show'])->name('course_materi');

        // Materi Download
        Route::get('/{course}/bab/{courseBab}/materi/{courseMateri}/download/{fileID}/{fileName}', [CourseMateriController::class, 'materidownload'])->name('materi_download');

        // Course Favorite
        Route::get('/{course}/favs', function () { return abort(404); });
        Route::post('/{course}/favs', [CourseController::class, 'favscourse'])->name('course_favs');

        // Course Forum
        Route::get('/{course}/forum/baru/{bab?}/{materi?}', [ForumController::class, 'create'])->name('course_forum_create');
        Route::post('/{course}/forum/baru/{materi?}', [ForumController::class, 'store']);

        Route::get('/{course}/forum/{forum}', [ForumController::class, 'show'])->name('course_forum_show');

        Route::get('/{course}/forum/{forum}/edit/thread', [ForumController::class, 'edit'])->name('course_forum_edit_thread');
        Route::patch('/{course}/forum/{forum}/edit/thread', [ForumController::class, 'update']);

        Route::get('/{course}/forum/{forum}/hapus/thread', function () { return abort(404); });
        Route::delete('/{course}/forum/{forum}/hapus/thread', [ForumController::class, 'destroy'])->name('course_forum_delete_thread');

        Route::get('/{course}/forum/{forum}/balas', function () { return abort(404); });
        Route::post('/{course}/forum/{forum}/balas', [ForumController::class, 'reply'])->name('course_forum_reply');
        Route::get('/{course}/forum/{forum}/edit/balasan/{reply}', [ForumController::class, 'editreply'])->name('course_forum_edit_reply');
        Route::patch('/{course}/forum/{forum}/edit/balasan/{reply}', [ForumController::class, 'updatereply']);

        Route::get('/{course}/forum/{forum}/balasan/{reply}/hapus', function () { return abort(404); });
        Route::delete('/{course}/forum/{forum}/balasan/{reply}/hapus', [ForumController::class, 'destroyreply'])->name('course_forum_delete_reply');

//        Route::middleware(['ajax'])->group(function () {
//            Route::get('/{course}/forum/{forum}/quote/{id}', [ForumController::class, 'getquote']);
//        });

        // Course Reviews
        Route::post('/{course}/ulasan', [CourseReviewController::class, 'store']);
        Route::delete('/{course}/ulasan/{ulasan}/hapus', [CourseReviewController::class, 'store']);
    });

    Route::get('/', [CourseController::class, 'index'])->name('courses');
    Route::get('/{course}', [CourseController::class, 'show'])->name('course_show');
    Route::get('/{course}/forum', [ForumController::class, 'index'])->name('course_forum');
    Route::get('/{course}/ulasan', [CourseReviewController::class, 'index'])->name('course_review');
});

// Prevent GET for logout
Route::get('/auth/keluar', function () { return abort(404); });

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
