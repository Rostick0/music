<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'seo_title',
        'seo_description',
        'path'
    ];
}
