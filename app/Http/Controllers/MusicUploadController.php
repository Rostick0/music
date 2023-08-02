<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MusicUploadController extends Controller
{
    private static function getPath($type = 'music')
    {
        return 'upload/' . $type . '/';
    }

    public static function upload($request, $type = 'music')
    {
        if (!$request) return NULL;

        $extension = $request->getClientOriginalExtension();
        $music = time() . '.' . $extension;
        $request->storeAs('public/' . MusicUploadController::getPath($type), $music);

        return $music;
    }

    public static function getViewLink($link, $type = 'music')
    {
        if (Storage::disk('public')->exists(MusicUploadController::getPath($type) . $link)) return Storage::url(MusicUploadController::getPath($type) . $link);

        return;
    }

    public static function check($link, $type = 'music')
    {
        return $link && Storage::disk('public')->exists(MusicUploadController::getPath($type) . $link);
    }

    public static function destroy($music_path, $type = 'music')
    {
        if (!Storage::disk('public')->exists(MusicUploadController::getPath($type) . $music_path)) {
            return;
        }

        return Storage::disk('public')->delete(MusicUploadController::getPath($type) . $music_path);
    }
}
