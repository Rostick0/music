<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientUserController extends Controller
{
    public function edit()
    {
        $user = User::find(auth()->id());

        return view('client.profile_edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'max:255',
            'telephone' => 'nullable',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        User::find(auth()->id())->update($validated);

        return back();
    }

    public function password_update(Request $request)
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
