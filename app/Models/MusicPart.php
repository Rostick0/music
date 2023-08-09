<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'music_id',
        'name',
        'link',
        'duration'
    ];
}
