<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicKit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'duration',
        'music_id'
    ];
}
