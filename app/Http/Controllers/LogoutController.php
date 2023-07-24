<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function store(Request $request)
    {
        Auth::logout();
        $request->session()->flush();

        return redirect('/');
    }
}
