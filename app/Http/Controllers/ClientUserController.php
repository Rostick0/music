<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientUserController extends Controller
{
    public function index()
    {
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
