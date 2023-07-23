<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationshipPlaylist extends Model
{
    use HasFactory;

    protected $fillable = [
        'music_id',
        'playlists_id',
    ];
}
