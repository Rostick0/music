<?php

namespace App\Observers;

use App\Models\Playlist;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;

class PlaylistObserver
{
    /**
     * Handle the Playlist "created" event.
     */
    public function created(Playlist $playlist): void
    {
        //
    }

    /**
     * Handle the Playlist "updated" event.
     */
    public function updated(Playlist $playlist): void
    {
        //
    }

    /**
     * Handle the Playlist "deleted" event.
     */
    public function deleted(Playlist $playlist): void
    {
        $where_sql = [
            ['type', '=', 'playlist'],
            ['type_id', '=', $playlist->id]
        ];

        RelationshipMood::where($where_sql)->delete();
        RelationshipTheme::where($where_sql)->delete();
        RelationshipInstrument::where($where_sql)->delete();
    }

    /**
     * Handle the Playlist "restored" event.
     */
    public function restored(Playlist $playlist): void
    {
        //
    }

    /**
     * Handle the Playlist "force deleted" event.
     */
    public function forceDeleted(Playlist $playlist): void
    {
        //
    }
}
