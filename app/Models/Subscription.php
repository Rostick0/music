<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_types_id',
        'user_id',
        'is_auto_renewal',
        'date_end',
    ];

    public function subscription_type(): BelongsTo
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_types_id', 'id');
    }
}
