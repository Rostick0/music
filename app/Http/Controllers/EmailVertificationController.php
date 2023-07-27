<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVertificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function dd() {
        
    }

    public function notification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
