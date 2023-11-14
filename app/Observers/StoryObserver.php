<?php

namespace App\Observers;

use App\Models\License;
use App\Models\Story;
use App\Utils\GeneratorString;
use App\Utils\LicenseCode;

class StoryObserver
{
    /**
     * Handle the Story "created" event.
     */
    public function created(Story $story): void
    {
        $code = LicenseCode::normalize(
            LicenseCode::unic()
        );

        License::firstOrCreate(
            [
                'licensesable_type' => $story->storysable_type,
                'licensesable_id' => $story->storysable_id,
                'user_id' => $story->user_id,
            ],
            [
                'code' => $code
            ]
        );
    }

    /**
     * Handle the Story "updated" event.
     */
    // public function updated(Story $story): void
    // {
    //     //
    // }

    /**
     * Handle the Story "deleted" event.
     */
    // public function deleted(Story $story): void
    // {
    //     //
    // }

    /**
     * Handle the Story "restored" event.
     */
    // public function restored(Story $story): void
    // {
    //     //
    // }

    /**
     * Handle the Story "force deleted" event.
     */
    // public function forceDeleted(Story $story): void
    // {
    //     //
    // }
}
