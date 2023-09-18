<?php

namespace App\Observers;

use App\Http\Controllers\MusicUploadController;
use App\Models\Favorite;
use App\Models\MusicKit;

class MusicKitObserver
{
    /**
     * Handle the MusicKit "created" event.
     */
    public function created(MusicKit $musicKit): void
    {
        //
    }

    /**
     * Handle the MusicKit "updated" event.
     */
    public function updated(MusicKit $musicKit): void
    {
        //
    }

    /**
     * Handle the MusicKit "deleted" event.
     */
    public function deleted(MusicKit $musicKit): void
    {
        MusicUploadController::destroy($musicKit->link, 'music_kit');
        Favorite::where([
            ['type', '=', 'music_kit'],
            ['type_id', '=', $musicKit->id]
        ]);
    }

    /**
     * Handle the MusicKit "restored" event.
     */
    public function restored(MusicKit $musicKit): void
    {
        //
    }

    /**
     * Handle the MusicKit "force deleted" event.
     */
    public function forceDeleted(MusicKit $musicKit): void
    {
        //
    }
}
