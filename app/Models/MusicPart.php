<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MusicPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'type',
        'title',
        'link',
        'duration'
    ];

    public function favorite(): BelongsTo
    {
        return $this->belongsTo(Favorite::class, 'id', 'type_id')->where('type', 'part');
    }
}
