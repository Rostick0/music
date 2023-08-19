<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Instrument;
use App\Models\Mood;
use App\Models\Music;
use App\Models\MusicArtist;
use App\Models\MusicKit;
use App\Models\RelationshipGenre;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Validation\Rule;
use Psy\VersionUpdater\Installer;
use wapmorgan\Mp3Info\Mp3Info;

class MusicKitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $where_sql = [];
        if ($request->title) $where_sql[] = ['music_kits.title', 'LIKE', '%' . $request->title . '%'];
        if ($request->music_artists) $where_sql[] = ['music_artists.name', 'LIKE', '%' . $request->music_artists . '%'];

        $music_kits = MusicKit::select(
            'music_kits.*',
            'music_artists.name as music_artist_name',
        )
            ->join('music_artists', 'music_kits.music_artist_id', '=', 'music_artists.id')
            ->where($where_sql)
            ->orderByDesc('id');
        if ($request->genres) {
            $music_kits->whereIn('music_kits.id', RelationshipGenre::select('type_id')
                ->where('type', 'music_kits')
                ->whereIn('genre_id', $request->genres)
                ->get());
        }
        if ($request->themes) {
            $music_kits->whereIn('music_kits.id', RelationshipTheme::select('type_id')
                ->where('type', 'music_kits')
                ->whereIn('theme_id', $request->themes)
                ->get());
        }
        if ($request->instruments) {
            $music_kits->whereIn('music_kits.id', RelationshipInstrument::select('type_id')
                ->where('type', 'music_kits')
                ->whereIn('instrument_id', $request->instruments)
                ->get());
        }
        if ($request->moods) {
            $music_kits->whereIn('music_kits.id', RelationshipMood::select('type_id')
                ->where('type', 'music_kits')
                ->whereIn('mood_id', $request->moods)
                ->get());
        }
        if ($request->min_time && $request->max_time) {
            $music_kits->whereBetween('duration', [$request->min_time, $request->max_time]);
        } else if ($request->min_time && !$request->max_time) {
            $music_kits->where('duration', '>', $request->min_time);
        } else if (!$request->min_time && $request->max_time) {
            $music_kits->where('duration', '<', $request->max_time);
        }
        $music_kits = $music_kits->paginate(app('site')->count_admin ?? 20);

        $genres = Genre::all();
        $themes = Theme::all();
        $instruments = Instrument::all();
        $moods = Mood::all();

        return view('admin.music_kit_list', [
            'music_kits' => $music_kits,
            'genres' => $genres,
            'themes' => $themes,
            'instruments' => $instruments,
            'moods' => $moods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $music_list = Music::orderByDesc('id')->limit(20)->get();
        $genres = Genre::all();

        return view('admin.music_kit_create', [
            'music_list' => $music_list,
            'genres' => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'music_artists' => 'required',
            'title' => 'required|max:255',
            'link' => 'required|mimes:mp3,wav',
            'link_demo' => 'required|mimes:mp3,wav',
            'publisher' => 'max:255',
            'distr' => 'max:255',
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255',
        ]);

        $music_artists = MusicArtist::firstOrCreate([
            'name' => trim($request->music_artists)
        ]);

        $image = ImageController::upload($request->file('image'));

        $audio = new Mp3Info($request->link, true);
        $duration = gmdate("H:i:s", $audio->duration);
        $music = MusicUploadController::upload($request->file('link'), 'music_kit');
        $music_demo = MusicUploadController::upload($request->file('link_demo'), 'music_kit_demo');

        $music_kit = MusicKit::create([
            'music_artist_id' => $music_artists->id,
            'title' => $request->title,
            'link' => $music,
            'link_demo' => $music_demo,
            'publisher' => $request->publisher,
            'distr' => $request->distr,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_free' => $request->has('is_free') ? 1 : 0,
            'description' => $request->description,
            'image' => $image,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'duration' => $duration
        ]);

        RelationshipGenreController::createAndDeleteRelationship($request->genres, $music_kit->id, 'music_kit');
        RelationshipInstrumentController::createRelationship($request->instruments, $music_kit->id, 'music_kit');
        RelationshipMoodController::createRelationship($request->moods, $music_kit->id, 'music_kit');
        RelationshipThemeController::createRelationship($request->themes, $music_kit->id, 'music_kit');

        return redirect()->route('music_kit.edit', [
            'id' => $music_kit->id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $music_kit = MusicKit::findOrFail($id);

        $music_artist = MusicArtist::find($music_kit->music_artist_id);

        $genres = Genre::all();

        return view('admin.music_kit_edit', [
            'music_kit' => $music_kit,
            'genres' => $genres,
            'music_artist' => $music_artist
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = $request->validate([
            'music_artists' => 'required',
            'title' => 'required|max:255',
            'link' => 'mimes:mp3,wav',
            'link_demo' => 'mimes:mp3,wav',
            'publisher' => 'max:255',
            'distr' => 'max:255',
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255',
        ]);

        $music_kit_old = MusicKit::find($id);

        $music_artists = MusicArtist::firstOrCreate([
            'name' => trim($request->music_artists)
        ]);

        $update_data = [
            'music_artist_id' => $music_artists->id,
            'title' => $request->title,
            'publisher' => $request->publisher,
            'distr' => $request->distr,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_free' => $request->has('is_free') ? 1 : 0,
            'description' => $request->description,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ];

        $image = ImageController::upload($request->file('image'));
        $upload = MusicUploadController::upload($request->file('link'), 'music_kit');
        $upload_demo = MusicUploadController::upload($request->file('link_demo'), 'music_kit_demo');

        if ($upload) {
            $audio = new Mp3Info($request->file('link'), true);
            $audio_duration = gmdate("H:i:s", $audio->duration);

            $update_data['link'] = $upload;
            $update_data['duration'] = $audio_duration;

            MusicUploadController::destroy($music_kit_old->link, 'music_kit');
        }

        if ($upload_demo) {
            $update_data['link_demo'] = $upload_demo;

            if ($music_kit_old->link_demo) MusicUploadController::destroy($music_kit_old->link_demo, 'music_kit_demo');
        }

        if ($image) {
            $update_data['image'] = $image;

            if ($music_kit_old->image) ImageController::destroy($music_kit_old->image);
        }

        RelationshipGenreController::createAndDeleteRelationship($request->genres, $id, 'music_kit');
        RelationshipInstrumentController::createAndDeleteRelationship($request->instruments, $id, 'music_kit');
        RelationshipMoodController::createAndDeleteRelationship($request->moods, $id, 'music_kit');
        RelationshipThemeController::createAndDeleteRelationship($request->themes, $id, 'music_kit');

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
