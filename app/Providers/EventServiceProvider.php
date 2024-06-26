<?php

namespace App\Providers;

use App\Events\BookListedSuccessfully;
use App\Events\CartChanged;
use App\Events\PurchaseSuccessful;
use App\Listeners\AddToInventory;
use App\Listeners\UpdateCartTotalPrice;
use App\Listeners\UpdateInventory;
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
        PurchaseSuccessful::class => [
            UpdateInventory::class,
        ],
        BookListedSuccessfully::class => [
            AddToInventory::class,
        ],
        CartChanged::class => [
            UpdateCartTotalPrice::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
