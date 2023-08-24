<?php

namespace App\Http\Controllers;

use App\Models\MusicArtist;
use App\Models\MusicPart;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MusicPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'part_link' => 'required|mimes:mp3,wav',
            'type' => 'in:music,music_kit'
        ]);

        $getId3 = new getID3();
        $audio = $getId3->analyze($request->file('part_link'));
        $duration = gmdate("H:i:s", $audio['playtime_seconds']);
        $link = MusicUploadController::upload($request->file('part_link'), 'part');

        $music_part = MusicPart::create([
            'type_id' => $request->type_id,
            'title' => $request->part_title,
            'link' => $link,
            'duration' => $duration,
            'type' => $request->type
        ]);

        return back();
    }

    public function edit(int $id)
    {
        $music_part = MusicPart::findOrFail($id);

        return view('admin.music_part_edit', [
            'music_part' => $music_part
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'link' => 'mimes:mp3,wav',
        ]);

        $link = null;
        $duration = null;

        if ($request->file('link')) {
            $getId3 = new getID3();
            $audio = $getId3->analyze($request->file('link'));
            $duration = gmdate("H:i:s", $audio['playtime_seconds']);
            $link = MusicUploadController::upload($request->file('link'), 'part');
        }

        $update_date = [
            'title' => $request->title,
        ];

        if ($link) $update_date['link'] = $link;
        if ($duration) $update_date['duration'] = $duration;

        MusicPart::find($id)->update($update_date);

        return back()->with('success', 'Успешно измененно');
    }

    public function destroy(int $id)
    {
        MusicPart::destroy($id);

        return back();
    }
}
