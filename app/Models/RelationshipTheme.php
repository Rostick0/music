<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationshipTheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'type_id',
        'theme_id'
    ];    
}
