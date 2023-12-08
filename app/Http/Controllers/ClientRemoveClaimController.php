<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\RemoveClaim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientRemoveClaimController extends Controller
{
    public function index()
    {
        $remove_claims = RemoveClaim::where('user_id', auth()->id())
            ->orderByDesc('id')
            ->paginate(app('site')->count_front);

        return view('client.remove_claim_list', [
            'remove_claims' => $remove_claims
        ]);
    }

    public function create()
    {
        $music_list = Music::orderByDesc('id')->limit(20)->get();

        return view('client.remove_claim_create', [
            'music_list' => $music_list
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'link' => 'required|max:255',
            'music_id' => 'required'
        ]);

        $data = RemoveClaim::create([
            ...$validated,
            'user_id' => auth()->id()
        ]);

        return new JsonResponse([
            'data' => $$data
        ]);

        // return redirect()->route('client.remove_claim.list');
    }
}
