<?php

namespace App\Http\Controllers;

use App\Models\MusicKit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use wapmorgan\Mp3Info\Mp3Info;

class MusicKitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $where_sql = [];

        if ($request->name) $where_sql[] = ['music_kits', 'LIKE', '%' . $request->name . '%'];
        if ($request->link) $where_sql[] = ['music_kits', 'LIKE', '%' . $request->link . '%'];

        $music_kits = MusicKit::where($where_sql);

        if ($request->min_time && $request->max_time) {
            $music_kits->whereBetween('duration', [$request->min_time, $request->max_time]);
        } else if ($request->min_time && !$request->max_time) {
            $music_kits->where('duration', '>', $request->min_time);
        } else if (!$request->min_time && $request->max_time) {
            $music_kits->where('duration', '<', $request->max_time);
        }

        $music_kits = $music_kits->paginate(20);

        return view('admin.music_kit_list', [
            'music_kits' => $music_kits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.music_kit_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required|max:255',
            'music_id' => 'required|' . Rule::exists('music', 'id'),
        ]);

        $audio = new Mp3Info($request->link, true);
        $duration = gmdate("H:i:s", $audio->duration);

        $music_kit = MusicKit::create([
            'name' => $request->name,
            'link' => $request->link,
            'music_id' => $request->music_id,
            'duration' => $duration
        ]);

        return redirect()->route('music_kit.edit', [
            'id' => $music_kit->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MusicKit $musicKit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $music_kit = MusicKit::select(
            'music_kits.*',
            'music.title as music_title',
        )
            ->join('music', 'music.id', '=', 'music_kits.music_id')
            ->where('music_kits.id', $id)
            ->first();

        // dd($music_kit);

        return view('admin.music_kit_edit', [
            'music_kit' => $music_kit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required|max:255',
            'music_id' => 'required|' . Rule::exists('music', 'id'),
        ]);

        $audio = new Mp3Info($request->link, true);
        $duration = gmdate("H:i:s", $audio->duration);

        MusicKit::where('id', $id)->update([
            'name' => $request->name,
            'link' => $request->link,
            'music_id' => $request->music_id,
            'duration' => $duration
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $music_kit_name = MusicKit::find($id)->name;
        $delete = MusicKit::destroy($id);

        return redirect(route('deleted', [
            'text' => 'Music kit удален ' . $music_kit_name
        ]));
    }
}
