<?php

namespace App\Observers;

use App\Models\Music;

class PlaylistObserver
{
    /**
     * Handle the Music "created" event.
     */
    public function created(Music $music): void
    {
        //
    }

    /**
     * Handle the Music "updated" event.
     */
    public function updated(Music $music): void
    {
        //
    }

    /**
     * Handle the Music "deleted" event.
     */
    public function deleted(Music $music): void
    {
        //
    }

    /**
     * Handle the Music "restored" event.
     */
    public function restored(Music $music): void
    {
        //
    }

    /**
     * Handle the Music "force deleted" event.
     */
    public function forceDeleted(Music $music): void
    {
        //
    }
}
