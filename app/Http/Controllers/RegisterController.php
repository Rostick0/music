<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'max:255',
            'nickname' => 'required|unique:users,nickname|max:255|regex:/^[a-z-_A-Z\d]+/',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:6|max:255',
            // 'telephone' => ''
            // password_confirmation
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'nickname' => $request->nickname,
            'email' =>  $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone
        ]);

        Auth::login($user);
        FavoriteController::insertDb();

        if ($user->is_admin) return redirect()->route('admin.music');

        return redirect()->route('client.profile_edit', [
            'user' => $user
        ]);
    }
}
