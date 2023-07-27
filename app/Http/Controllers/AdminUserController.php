<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function edit()
    {
        $user = User::find(1);

        return view('admin.profile_edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'surname' => 'max:255',
            'nickname' => 'required|unique:users|max:255|regex:/^[a-z-_A-Z\d]+/',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user()->id,
            'password' => 'required|confirmed|min:6|max:255',
        ]);

        User::find()->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'nickname' => $request->nickname,
            // 'email' => $request->email,
            'telephone' => $request->telephone,
        ]);

        return back();
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6|max:255',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        User::find($user->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password updated successfully');
    }
}
