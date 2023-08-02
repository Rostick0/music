<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MusicDownloadController extends Controller
{
    public static function getLink($link, $link_demo, $is_free = true)
    {
        if (
            $is_free
            || 
            (app('has_subscription'))
        ) {
            return MusicUploadController::getViewLink($link, 'music');
        }

        return MusicUploadController::getViewLink($link_demo, 'music_demo');
    }
}
