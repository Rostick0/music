<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'url',
        'type',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
