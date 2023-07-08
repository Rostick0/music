<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function index()
    {
        return view('admin.users');
    }

    public function show()
    {
        return view('client.profile');
    }

    public function edit()
    {
        return view('client.profile_edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    public function password_update(Request $request)
    {
        //
    }
}
