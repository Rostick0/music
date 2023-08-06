<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Instrument;
use App\Models\Mood;
use App\Models\Music;
use App\Models\MusicArtist;
use App\Models\RelationshipGenre;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use wapmorgan\Mp3Info\Mp3Info;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $where_sql = [];
        if ($request->title) $where_sql[] = ['music.title', 'LIKE', '%' . $request->title . '%'];
        if ($request->music_artists) $where_sql[] = ['music_artists.name', 'LIKE', '%' . $request->music_artists . '%'];

        $music_list = Music::select(
            'music.*',
            'music_artists.name as music_artist_name',
        )
            ->join('music_artists', 'music.music_artist_id', '=', 'music_artists.id')
            ->where($where_sql)
            ->orderByDesc('id');
        if ($request->genres) {
            $music_list->whereIn('music.id', RelationshipTheme::select('type_id')
                ->where('type', 'music')
                ->whereIn('genre_id', $request->genres)
                ->get());
        }
        if ($request->themes) {
            $music_list->whereIn('music.id', RelationshipTheme::select('type_id')
                ->where('type', 'music')
                ->whereIn('theme_id', $request->themes)
                ->get());
        }
        if ($request->instruments) {
            $music_list->whereIn('music.id', RelationshipInstrument::select('type_id')
                ->where('type', 'music')
                ->whereIn('instrument_id', $request->instruments)
                ->get());
        }
        if ($request->moods) {
            $music_list->whereIn('music.id', RelationshipMood::select('type_id')
                ->where('type', 'music')
                ->whereIn('mood_id', $request->moods)
                ->get());
        }
        if ($request->min_time && $request->max_time) {
            $music_list->whereBetween('duration', [$request->min_time, $request->max_time]);
        } else if ($request->min_time && !$request->max_time) {
            $music_list->where('duration', '>', $request->min_time);
        } else if (!$request->min_time && $request->max_time) {
            $music_list->where('duration', '<', $request->max_time);
        }
        $music_list = $music_list->paginate(app('site')->count_admin ?? 20);

        $genres = Genre::all();
        $themes = Theme::all();
        $instruments = Instrument::all();
        $moods = Mood::all();

        return view('admin.music_list', [
            'music_list' => $music_list,
            'genres' => $genres,
            'themes' => $themes,
            'instruments' => $instruments,
            'moods' => $moods
        ]);
    }

    public function search(Request $request, $type = 'json')
    {
        $where_sql = [];
        if ($request->title) $where_sql[] = ['music.title', 'LIKE', '%' . $request->title . '%'];
        if ($request->music_artists) $where_sql[] = ['music_artists.name', 'LIKE', '%' . $request->music_artists . '%'];
        if (!(auth()->check() && auth()->user()->is_admin)) $where_sql[] = ['is_active', '=', 1];

        if ($request->count && $request->count > app('site')->count_front) {
            $count = app('site')->count_front;
        } else {
            $count = $request->count ?? app('site')->count_front;
        }

        $music_list = Music::select(
            'music.*',
            'music_artists.name as music_artist_name',
            'favorites.id as favorite_id'
        )
            ->join('music_artists', 'music.music_artist_id', '=', 'music_artists.id')
            ->leftJoin('favorites', function (JoinClause $join) {
                $join->on('favorites.music_id', '=', 'music.id')
                    ->where('favorites.user_id', auth()->id());
            })
            ->where($where_sql)
            ->orderByDesc('id');
        if ($request->genres) {
            $music_list->whereIn('music.id', RelationshipGenre::select('type_id')
                ->where('type', 'music')
                ->whereIn('genre_id', is_array($request->genres) ? $request->genres : [$request->genres])
                ->get());
        }
        if ($request->themes) {
            $music_list->whereIn('music.id', RelationshipTheme::select('type_id')
                ->where('type', 'music')
                ->whereIn('theme_id', is_array($request->themes) ? $request->themes : [$request->themes])
                ->get());
        }
        if ($request->instruments) {
            $music_list->whereIn('music.id', RelationshipInstrument::select('type_id')
                ->where('type', 'music')
                ->whereIn('instrument_id', is_array($request->instruments) ? $request->instruments : [$request->instruments])
                ->get());
        }
        if ($request->moods) {
            $music_list->whereIn('music.id', RelationshipMood::select('type_id')
                ->where('type', 'music')
                ->whereIn('mood_id', is_array($request->moods) ? $request->moods : [$request->moods])
                ->get());
        }
        if ($request->min_time && $request->max_time) {
            $music_list->whereBetween('duration', [$request->min_time, $request->max_time]);
        } else if ($request->min_time && !$request->max_time) {
            $music_list->where('duration', '>', $request->min_time);
        } else if (!$request->min_time && $request->max_time) {
            $music_list->where('duration', '<', $request->max_time);
        }

        $music_list = $music_list->paginate($count);

        if ($type === 'json') return response(
            [
                'data' => $music_list,
                'links_html' => Blade::compileString($music_list->appends($request->all())->links('vendor.front-pagination'))
            ]
        );

        return $music_list;
    }

    public static function normalizeTime($duration)
    {
        $time = substr($duration, 0, -3);

        if ($time[0] == '0') $time = substr($time, 1);

        return $time;
    }

    public function create()
    {
        $genres = Genre::all();

        return view('admin.music_create', [
            'genres' => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'music_artists' => 'required',
            'title' => 'required|max:255',
            'link' => 'required|mimes:mp3',
            'link_demo' => 'mimes:mp3',
            'publisher' => 'max:255',
            'distr' => 'max:255',
            'date' => 'date',
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $music_artists = MusicArtist::firstOrCreate([
            'name' => trim($request->music_artists)
        ]);

        $image = ImageController::upload($request->file('image'));
        $music = MusicUploadController::upload($request->file('link'));
        $music_demo = MusicUploadController::upload($request->file('link_demo'), 'music_demo');

        $audio = new Mp3Info($request->link, true);
        $audio_duration = gmdate("H:i:s", $audio->duration);

        $music = Music::create([
            'music_artist_id' => $music_artists->id,
            'title' => $request->title,
            'link' => $music,
            'link_demo' => $music_demo,
            'publisher' => $request->publisher,
            'distr' => $request->distr,
            'create_date' => $request->create_date,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_free' => $request->has('is_free') ? 1 : 0,
            'description' => $request->description,
            'image' => $image,
            'duration' => $audio_duration,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ]);

        RelationshipGenreController::createAndDeleteRelationship($request->genres, $music->id, 'music');
        RelationshipInstrumentController::createRelationship($request->instruments, $music->id, 'music');
        RelationshipMoodController::createRelationship($request->moods, $music->id, 'music');
        RelationshipThemeController::createRelationship($request->themes, $music->id, 'music');

        return redirect()->route('music.edit', [
            'id' => $music->id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $music = Music::findOrFail($id);
        $music_artist = MusicArtist::find($music->music_artist_id);

        $genres = Genre::select(
            'genres.*',
            'relationship_genres.id as relationship_id'
        )->leftJoin('relationship_genres', function ($join) use ($music) {
            $join->on('relationship_genres.genre_id', '=', 'genres.id')
                ->where([
                    ['type_id', '=', $music->id],
                    ['type', '=', 'music']
                ]);
        })->get();

        return view('admin.music_edit', [
            'music' => $music,
            'music_artist' => $music_artist,
            'genres' => $genres,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'music_artists' => 'required',
            'title' => 'max:255',
            'link' => 'mimes:mp3',
            'link_demo' => 'mimes:mp3',
            'publisher' => 'max:255',
            'distr' => 'max:255',
            'create_date' => 'date',
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $music_old = Music::find($id);

        $music_artists = MusicArtist::firstOrCreate([
            'name' => trim($request->music_artists)
        ]);

        $image = ImageController::upload($request->file('image'));
        $upload = MusicUploadController::upload($request->file('link'));
        $upload_demo = MusicUploadController::upload($request->file('link_demo'), 'music_demo');

        $update_data = [
            'music_artist_id' => $music_artists->id,
            'title' => $request->title,
            'publisher' => $request->publisher,
            'distr' => $request->distr,
            'create_date' => $request->create_date,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_free' => $request->has('is_free') ? 1 : 0,
            'description' => $request->description,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ];

        if ($upload) {
            $audio = new Mp3Info($request->link, true);
            $audio_duration = gmdate("H:i:s", $audio->duration);

            $update_data['link'] = $upload;
            $update_data['duration'] = $audio_duration;

            MusicUploadController::destroy($music_old->link);
        }

        if ($upload_demo) {
            $update_data['link_demo'] = $upload_demo;

            if ($music_old->link_demo) MusicUploadController::destroy($music_old->link_demo, 'music_demo');
        }

        if ($image) {
            $update_data['image'] = $image;

            if ($music_old->image) ImageController::destroy($music_old->image);
        }

        $music_old->update($update_data);

        RelationshipGenreController::createAndDeleteRelationship($request->genres, $id, 'music');
        RelationshipInstrumentController::createAndDeleteRelationship($request->instruments, $id, 'music');
        RelationshipMoodController::createAndDeleteRelationship($request->moods, $id, 'music');
        RelationshipThemeController::createAndDeleteRelationship($request->themes, $id, 'music');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $music = Music::find($id);
        Music::destroy($id);

        return redirect(route('deleted', [
            'text' => 'Музыка удалена ' . $music->title
        ]));
    }
}
