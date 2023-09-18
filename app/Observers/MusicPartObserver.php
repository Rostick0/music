<?php

namespace App\Observers;

use App\Models\Favorite;
use App\Models\MusicPart;

class MusicPartObserver
{
    /**
     * Handle the MusicPart "created" event.
     */
    public function created(MusicPart $musicPart): void
    {
        //
    }

    /**
     * Handle the MusicPart "updated" event.
     */
    public function updated(MusicPart $musicPart): void
    {
        //
    }

    /**
     * Handle the MusicPart "deleted" event.
     */
    public function deleted(MusicPart $musicPart): void
    {
        Favorite::where([
            ['type_id', '=', $musicPart->id],
            ['type', '=', 'part'],
        ]);
    }

    /**
     * Handle the MusicPart "restored" event.
     */
    public function restored(MusicPart $musicPart): void
    {
        //
    }

    /**
     * Handle the MusicPart "force deleted" event.
     */
    public function forceDeleted(MusicPart $musicPart): void
    {
        //
    }
}
