<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RemoveClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'status',
        'music_id',
        'user_id'
    ];

    function music(): BelongsTo
    {
        return $this->belongsTo(Music::class, 'music_id', 'id');
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
