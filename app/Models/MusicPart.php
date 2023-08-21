<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MusicPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'type',
        'title',
        'link',
        'music_artist_id',
        'duration'
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(MusicArtist::class, 'music_artist_id', 'id')->select('music_artists.name as artist_name');
    }
}
