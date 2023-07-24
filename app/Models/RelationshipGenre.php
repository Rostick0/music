<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationshipGenre extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'type_id',
        'genres_id'
    ];
}
