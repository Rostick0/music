<?php

namespace App\Http\Controllers;

use App\Models\MusicPart;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use wapmorgan\Mp3Info\Mp3Info;

class MusicPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'part_name' => 'required|max:255',
            'part_link' => 'required|mimes:mp3,wav',
            'type' => 'in:music,music_kit'
        ]);


        $audio = new Mp3Info($request->part_link, true);
        $duration = gmdate("H:i:s", $audio->duration);
        $music = MusicUploadController::upload($request->file('part_link'), 'part');

        MusicPart::create([
            'type_id' => $request->type_id,
            'name' => $request->part_name,
            'link' => $music,
            'duration' => $duration,
            'type' => $request->type
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(MusicPart $musicPart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MusicPart $musicPart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MusicPart $musicPart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        MusicPart::destroy($id);

        return back();
    }
}
