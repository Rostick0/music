<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\MusicKit;
use App\Models\RelationshipGenre;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
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

        $music_kits = MusicKit::where($where_sql)
            ->orderByDesc('id');

        if ($request->min_time && $request->max_time) {
            $music_kits->whereBetween('duration', [$request->min_time, $request->max_time]);
        } else if ($request->min_time && !$request->max_time) {
            $music_kits->where('duration', '>', $request->min_time);
        } else if (!$request->min_time && $request->max_time) {
            $music_kits->where('duration', '<', $request->max_time);
        }

        $music_kits = $music_kits->paginate(app('site')->count_admin ?? 20);

        return view('admin.music_kit_list', [
            'music_kits' => $music_kits
        ]);
    }

    public function search(Request $request, $type = 'json')
    {
        $where_sql = [];
        if ($request->title) $where_sql[] = ['music.title', 'LIKE', '%' . $request->title . '%'];
        if ($request->music_artists) $where_sql[] = ['music_artists.name', 'LIKE', '%' . $request->music_artists . '%'];
        // if (!(auth()->check() && auth()->user()->is_admin)) $where_sql[] = ['music.is_active', '=', 1];

        if ($request->count && $request->count > app('site')->count_front) {
            $count = app('site')->count_front;
        } else {
            $count = $request->count;
        }

        $music_kit_list = Music::select(
            'music.title as music_title',
            'music.image as music_image',
            'music_artists.name as music_artist_name',
            'music_kits.*',
        )
            ->join('music_kits', 'music_kits.music_id', '=', 'music.id')
            ->join('music_artists', 'music.music_artist_id', '=', 'music_artists.id')
            ->where($where_sql)
            ->inRandomOrder()
            ->orderByDesc('id');
        if ($request->genres) {
            $music_kit_list->whereIn('music.id', RelationshipGenre::select('type_id')
                ->where('type', 'music')
                ->whereIn('genre_id', is_array($request->genres) ? $request->genres : [$request->genres])
                ->get());
        }
        if ($request->themes) {
            $music_kit_list->whereIn('music.id', RelationshipTheme::select('type_id')
                ->where('type', 'music')
                ->whereIn('theme_id', is_array($request->themes) ? $request->themes : [$request->themes])
                ->get());
        }
        if ($request->instruments) {
            $music_kit_list->whereIn('music.id', RelationshipInstrument::select('type_id')
                ->where('type', 'music')
                ->whereIn('instrument_id', is_array($request->instruments) ? $request->instruments : [$request->instruments])
                ->get());
        }
        if ($request->moods) {
            $music_kit_list->whereIn('music.id', RelationshipMood::select('type_id')
                ->where('type', 'music')
                ->whereIn('mood_id', is_array($request->moods) ? $request->moods : [$request->moods])
                ->get());
        }

        $music_kit_list = $music_kit_list->paginate($count);

        if ($type === 'json') return response(
            [
                'data' => $music_kit_list,
                'links_html' => Blade::compileString($music_kit_list->appends($request->all())->links('vendor.front-pagination'))
            ]
        );

        return $music_kit_list;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $music_list = Music::orderByDesc('id')->limit(20)->get();

        return view('admin.music_kit_create', [
            'music_list' => $music_list
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required|mimes:mp3',
            'music_id' => 'required|' . Rule::exists('music', 'id'),
        ]);

        $audio = new Mp3Info($request->link, true);
        $duration = gmdate("H:i:s", $audio->duration);
        $music = MusicUploadController::upload($request->file('link'), 'music_kit');

        $music_kit = MusicKit::create([
            'name' => $request->name,
            'link' => $music,
            'music_id' => $request->music_id,
            'duration' => $duration
        ]);

        return redirect()->route('music_kit.edit', [
            'id' => $music_kit->id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $music_list = Music::orderByDesc('id')->limit(20)->get();

        $music_kit = MusicKit::select(
            'music_kits.*',
            'music.title as music_title',
        )
            ->join('music', 'music.id', '=', 'music_kits.music_id')
            ->where('music_kits.id', $id)
            ->first();

        return view('admin.music_kit_edit', [
            'music_kit' => $music_kit,
            'music_list' => $music_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'link' => 'mimes:mp3',
            'music_id' => 'required|' . Rule::exists('music', 'id'),
        ]);

        $music_kit_old = MusicKit::find($id);

        $update_data = [
            'name' => $request->name,
            'music_id' => $request->music_id,
        ];

        $upload = MusicUploadController::upload($request->file('link'), 'music_kit');

        if ($upload) {
            $audio = new Mp3Info($request->link, true);
            $audio_duration = gmdate("H:i:s", $audio->duration);

            $update_data['link'] = $upload;
            $update_data['duration'] = $audio_duration;

            MusicUploadController::destroy($music_kit_old->link, 'music_kit');
        }

        $music_kit_old->update($update_data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $music_kit = MusicKit::find($id);
        MusicKit::destroy($id);

        return redirect(route('deleted', [
            'text' => 'Music kit удален ' . $music_kit->name
        ]));
    }
}
