<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TokenController extends Controller
{
    private $token;

    public function create()
    {
        if (!auth()->check()) return;

        $this->reset();
        $this->token = auth()->user()->createToken('auth')->plainTextToken;
        // cookie('token', $this->token);
        return $this->token;
    }

    public function get()
    {
        // dd(Cookie::get('token'));
        if (!$this->token) return $this->create();

        return $this->token;
    }

    public function reset()
    {
        if (!auth()->check()) return;

        auth()->user()->tokens()->delete();
    }
}
