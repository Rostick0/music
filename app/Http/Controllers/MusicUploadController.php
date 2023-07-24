<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicUploadController extends Controller
{
    private static function getPath($type = 'music')
    {
        return 'public/upload/' . $type . '/';
    }

    public static function upload($request, $type = 'music')
    {
        if (!$request) return NULL;

        $extension = $request->getClientOriginalExtension();
        $music = time() . '.' . $extension;
        $request->storeAs(MusicUploadController::getPath($type), $music);

        return $music;
    }

    public static function getViewLink($music, $type = 'music')
    {
        if (Storage::exists(MusicUploadController::getPath($type) . $music)) return Storage::url(MusicUploadController::getPath($type) . $music);

        return;
    }

    public static function destroy($music_path, $type = 'music')
    {
        if (!Storage::exists(MusicUploadController::getPath($type) . $music_path)) {
            return;
        }

        return Storage::delete(MusicUploadController::getPath($type) . $music_path);
    }
}
