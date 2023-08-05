<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelationshipHelper extends Controller
{
    public static function getNameByItems($items, $if_empty = '')
    {
        $array_items = [...$items];

        if (empty($array_items)) return $if_empty;

        $items_map = array_map(function ($item) {
            return $item->name;
        }, $array_items);

        return implode(', ', $items_map);
    }
}
