<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Throttle;
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
        if (Auth::check()) return $this::redirectProfile();

        $credentials = $request->validate([
            'email' => ['required', new Throttle('contact-form', 3, 1)],
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials, true)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        if (Auth::check()) {
            FavoriteController::insertDb();
            return $this::redirectProfile();
        }

        return redirect()->route('login');
    }

    public static function redirectProfile()
    {
        return Auth::user()->is_admin ? redirect()->route('music.list') : redirect()->route('client.index', [
            'user' => User::find(auth()->id())
        ]);
    }
}
