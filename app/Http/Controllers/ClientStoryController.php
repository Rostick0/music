<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\MusicKit;
use App\Models\MusicPart;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stories = Story::where('user_id', auth()->id())
            ->paginate(app('site')->count_admin ?? 20);

        return view('client.story_list', [
            'stories' => $stories
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $audio = null;
        $validated = $request->validate([
            'type_id' => 'required|numeric',
            'type' => 'required|in:music,music_kit,music_part',
        ]);

        if ($request->type === 'music') {
            $audio = Music::findOrFail($request->type_id);
        } else if ($request->type === 'music_kit') {
            $audio = MusicKit::findOrFail($request->type_id);
        } else {
            $audio = MusicPart::findOrFail($request->type_id);
        }

        $data = $audio->stories()->create([
            'user_id' => auth()->id(),
        ]);
        // $data = Story::create([
        //     ...$validated,
        //     'user_id' => auth()->id(),
        // ]);

        return new JsonResponse([
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story)
    {
        //
    }
}
