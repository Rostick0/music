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
        return view('client.users');
    }
}
