<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelationshipHelper extends Controller
{
    public static function getNameByItems($items)
    {
        $items_map = array_map(function ($item) {
            return $item->name;
        }, [...$items]);

        return implode(', ', $items_map);
    }
}
