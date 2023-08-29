<?php

namespace App\Observers;

use App\Models\Notice;
use App\Models\RemoveClaim;
use Illuminate\Support\Facades\Mail;

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

        Mail::raw('Поступила новая заявка remove claim ссылка: ' . $removeClaim->link . ', на музыку: ' . $removeClaim->music->title .', ' . $removeClaim->music->artist->artist_name, function ($m) {
            $m->to('Avs29rus@mail.ru', '')->subject('Новое сообщение с сайта');
        });
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
