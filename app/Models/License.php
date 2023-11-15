<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'licensesable_type',
        'licensesable_id',
        'user_id',
        'code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function licensesable(): MorphTo
    {
        return $this->morphTo();
    }
}
