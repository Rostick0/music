<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemoveClaim extends Model
{
    use HasFactory;


    protected $fillable = [
        'link',
        'status',
        'music_id',
        'users_id'
    ];
}
