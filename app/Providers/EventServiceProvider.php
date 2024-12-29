<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\RegistrationSubmitted;
use App\Listeners\SendRegistrationNotification;
use App\Events\RegistrationUpdated;
use App\Listeners\SendUpdateNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RegistrationSubmitted::class => [
            SendRegistrationNotification::class,
        ],
        RegistrationUpdated::class => [
            SendUpdateNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}