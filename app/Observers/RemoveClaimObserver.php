<?php

namespace App\Observers;

use App\Models\Notice;
use App\Models\RemoveClaim;

class RemoveClaimObserver
{
    /**
     * Handle the RemoveClaim "created" event.
     */
    public function created(RemoveClaim $removeClaim): void
    {
        Notice::create([
            'type' => 'remove_сlaim',
            'type_id' => $removeClaim->id,
        ]);
    }

    /**
     * Handle the RemoveClaim "updated" event.
     */
    public function updated(RemoveClaim $removeClaim): void
    {
        if ($removeClaim->status == 'closed') {
            Notice::where([
                'type' => 'remove_сlaim',
                'type_id' => $removeClaim->id,
            ])
            ->update([
                'is_read' => 1
            ]);
        }
    }

    /**
     * Handle the RemoveClaim "deleted" event.
     */
    public function deleted(RemoveClaim $removeClaim): void
    {
        //
    }

    /**
     * Handle the RemoveClaim "restored" event.
     */
    public function restored(RemoveClaim $removeClaim): void
    {
        //
    }

    /**
     * Handle the RemoveClaim "force deleted" event.
     */
    public function forceDeleted(RemoveClaim $removeClaim): void
    {
        //
    }
}
