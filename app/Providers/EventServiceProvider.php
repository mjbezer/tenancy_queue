<?php

namespace AtitudeAgenda\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use AtitudeAgenda\Events\ValidationNewClient;
Use AtitudeAgenda\Events\DatabaseCreated;
use AtitudeAgenda\Listeners\CreateDatabase;
use AtitudeAgenda\Listeners\RunMigration;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,             
        ],
        ValidationNewClient::class => [
            CreateDatabase::class,
       ],
        DatabaseCreated::class => [
            RunMigration::class,
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

        //
    }
}
