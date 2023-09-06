<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MusicDownloadController extends Controller
{
    public static function getLink($link, $link_demo, $is_free = true, $type = 'music')
    {
        if (
            $is_free
            ||
            (app('has_subscription'))
        ) {
            return MusicUploadController::getViewLink($link, $type);
        }

        return MusicUploadController::getViewLink($link_demo, $type . '_demo');
    }
}
