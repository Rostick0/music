<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'type_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function audio(): BelongsTo
    // {
    //     return $this->morphOne(ImageRelat::class, 'image_relatsable');
    //     // dd($this->);
    //     // return $this->belongsTo(Music::class, 'type_id', 'id');
    // }

    public function audio_relatsable(): MorphTo
    {
        return $this->morphTo();
    }
}
