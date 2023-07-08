<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        if (Auth::check()) return $this->redirectProfile();

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, true)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        if (Auth::check()) {
            return $this->redirectProfile();
        }

        return redirect()->route('login');
    }

    public function redirectProfile()
    {
        return Auth::user()->is_admin ? redirect()->route('admin.music') : redirect()->route('client.profile');
    }
}
