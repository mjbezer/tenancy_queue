<?php

namespace AtitudeAgenda\Listeners;

use AtitudeAgenda\Tenant\Database\DatabaseManager;
use AtitudeAgenda\Events\ValidationNewClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use AtitudeAgenda\Events\DatabaseCreated;

use Log;

class CreateDatabase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {


    }

    /**
     * Handle the event.
     *
     * @param  ValidationNewClient  $event
     * @return void
     */
    public function handle(ValidationNewClient $event)
    {
        $database= $event->getDatabase(); 
        DatabaseManager::newDatabase($database);
        event(new DatabaseCreated($database));
    }
}
