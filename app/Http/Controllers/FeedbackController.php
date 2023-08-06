<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'theme' => 'required|max:255',
            'message' => 'required|max:65536',
        ]);

        Feedback::create([
            'email' => $request->email,
            'theme' => $request->theme,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Thanks!');
    }
}
