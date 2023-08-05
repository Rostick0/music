<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'is_active',
        'seo_title',
        'seo_description'
    ];

    public function genres(): HasMany
    {
        return $this->hasMany(RelationshipGenre::class, 'type_id', 'id')->select('genres.name as name', 'genres.id as id')->join('genres', 'genres.id', '=', 'relationship_genres.genre_id')->where('type', 'playlist');
    }

    public function moods(): HasMany
    {
        return $this->hasMany(RelationshipMood::class, 'type_id', 'id')->select('moods.name as name', 'moods.id as id')->join('moods', 'moods.id', '=', 'relationship_moods.mood_id')->where('type', 'playlist');
    }

    public function instruments(): HasMany
    {
        return $this->hasMany(RelationshipInstrument::class, 'type_id', 'id')->select('instruments.name as name', 'instruments.id as id')->join('instruments', 'instruments.id', '=', 'relationship_instruments.instrument_id')->where('type', 'playlist');
    }

    public function themes(): HasMany
    {
        return $this->hasMany(RelationshipTheme::class, 'type_id', 'id')->select('themes.name as name', 'themes.id as id')->join('themes', 'themes.id', '=', 'relationship_themes.theme_id')->where('type', 'playlist');
    }

    public function music(): HasMany
    {
        return $this->hasMany(RelationshipPlaylist::class, 'playlist_id', 'id')
            ->select(
                'music.*',
                'relationship_playlists.id as relationship_playlist_id',
                'music_artists.name as music_artist_name'
            )
            ->join('music', 'music.id', '=', 'relationship_playlists.music_id')
            ->join('music_artists', 'music.music_artist_id', '=', 'music_artists.id');
    }
}
