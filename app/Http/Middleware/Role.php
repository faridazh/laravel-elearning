<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Role
{
    public function handle(Request $request, Closure $next, $role)
    {
        $roles = [
            'admin' => [1],
            'staff' => [1,2],
            'dosen' => [1,2,3],
        ];

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if(in_array(Auth::user()->role_id, $roles[$role]))
        {
            return $next($request);
        }

        Alert::toast('Anda tidak mempunyai akses!', 'error');
        return redirect()->route('home');
    }
}
