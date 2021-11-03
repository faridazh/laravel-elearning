<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Blade::if('admin', function () {
            return Auth::user() == true && Auth::user()->role_id == 1;
        });
        Blade::if('moderator', function () {
            return Auth::user() == true && in_array(Auth::user()->role_id, [1,2]);
        });
        Blade::if('dosen', function () {
            return Auth::user() == true && in_array(Auth::user()->role_id, [1,2,3]);
        });

        Paginator::defaultView('vendor.pagination.my-pagination');
        Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');
    }
}
