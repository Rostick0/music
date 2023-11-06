<?php

namespace App\Observers;

use App\Models\Feedback;
use Illuminate\Support\Facades\Mail;

class FeedbackObserver
{
    /**
     * Handle the Feedback "created" event.
     */
    public function created(Feedback $feedback): void
    {
        $text = 'Обратная связь'.PHP_EOL.' E-mail: ' . $feedback->email .PHP_EOL.'Тема: ' . $feedback->theme .PHP_EOL.'Сообщение: ' . $feedback->message;

        Mail::raw($text, function ($m) {
            $m->to(app('site')?->email, '')->subject('Новое сообщение с сайта');
        });
    }

    /**
     * Handle the Feedback "updated" event.
     */
    public function updated(Feedback $feedback): void
    {
        //
    }

    /**
     * Handle the Feedback "deleted" event.
     */
    public function deleted(Feedback $feedback): void
    {
        //
    }

    /**
     * Handle the Feedback "restored" event.
     */
    public function restored(Feedback $feedback): void
    {
        //
    }

    /**
     * Handle the Feedback "force deleted" event.
     */
    public function forceDeleted(Feedback $feedback): void
    {
        //
    }
}
