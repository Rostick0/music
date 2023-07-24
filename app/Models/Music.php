<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'music_artists_id',
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
}
