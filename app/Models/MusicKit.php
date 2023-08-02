<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MusicKit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'is_active',
        'duration',
        'music_id'
    ];

    public function music(): BelongsTo
    {
        return $this->belongsTo(Music::class);
    }
}
