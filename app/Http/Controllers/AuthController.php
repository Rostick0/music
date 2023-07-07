<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function show_login()
    {
        return view('client.login');
    }

    public function show_register() {
        return view('client.register');
    }

    public function store_login(Request $request)
    {
        
    }

    public function store_register(Request $request) {
        
    }
}
