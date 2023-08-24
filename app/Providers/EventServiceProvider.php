<?php

namespace App\Providers;

use App\Models\Feedback;
use App\Models\Playlist;
use App\Models\RemoveClaim;
use App\Models\Subscription;
use App\Models\User;
use App\Observers\FeedbackObserver;
use App\Observers\PlaylistObserver;
use App\Observers\RemoveClaimObserver;
use App\Observers\SubscriptionObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        RemoveClaim::observe(RemoveClaimObserver::class);
        Subscription::observe(SubscriptionObserver::class);
        Feedback::observe(FeedbackObserver::class);
        Playlist::observe(PlaylistObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
