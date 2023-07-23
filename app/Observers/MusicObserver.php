<?php

namespace App\Observers;

use App\Models\Music;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;

class MusicObserver
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
        $where_sql = [
            ['type', '=', 'music'],
            ['type_id', '=', $music->id]
        ];

        RelationshipMood::where($where_sql)->delete();
        RelationshipTheme::where($where_sql)->delete();
        RelationshipInstrument::where($where_sql)->delete();
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
