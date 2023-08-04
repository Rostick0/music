<?php

namespace App\Http\Controllers;

use App\Models\RemoveClaim;
use Illuminate\Http\Request;

class ClientRemoveClaimController extends Controller
{
    public function index()
    {
        // $user_id = auth()->id();

        return view('client.remove_claim');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'link' => 'required|max:255',
            'music_id' => 'required'
        ]);

        $user_id = auth()->id();

        $remove_claim = RemoveClaim::create([
            'link' => $request->link,
            'music_id' => $request->music_id,
            'user_id' => $user_id
        ]);

        return $remove_claim;
    }
}
