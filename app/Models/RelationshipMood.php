<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationshipMood extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'type_id',
        'music_id'
    ];
}
