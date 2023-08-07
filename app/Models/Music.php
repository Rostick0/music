<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'music_artist_id',
        'title',
        'link',
        'link_demo',
        'publisher',
        'distr',
        'create_date',
        'is_active',
        'is_free',
        'description',
        'image',
        'duration',
        'seo_title',
        'seo_description'
    ];

    public function genres(): HasMany
    {
        return $this->hasMany(RelationshipGenre::class, 'type_id', 'id')->select('genres.name as name', 'genres.id as id')->join('genres', 'genres.id', '=', 'relationship_genres.genre_id')->where('type', 'music');
    }

    public function moods(): HasMany
    {
        return $this->hasMany(RelationshipMood::class, 'type_id', 'id')->select('moods.name as name', 'moods.id as id')->join('moods', 'moods.id', '=', 'relationship_moods.mood_id')->where('type', 'music');
    }

    public function instruments(): HasMany
    {
        return $this->hasMany(RelationshipInstrument::class, 'type_id', 'id')->select('instruments.name as name', 'instruments.id as id')->join('instruments', 'instruments.id', '=', 'relationship_instruments.instrument_id')->where('type', 'music');
    }

    public function themes(): HasMany
    {
        return $this->hasMany(RelationshipTheme::class, 'type_id', 'id')->select('themes.name as name', 'themes.id as id')->join('themes', 'themes.id', '=', 'relationship_themes.theme_id')->where('type', 'music');
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(MusicArtist::class, 'music_artist_id', 'id')->select('music_artists.name as artist_name');
    }
}
