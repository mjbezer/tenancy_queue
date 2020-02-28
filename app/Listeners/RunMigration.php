<?php

namespace AtitudeAgenda\Listeners;

use AtitudeAgenda\Events\DatabaseCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class RunMigration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DatabaseCreated  $event
     * @return void
     */
    public function handle(DatabaseCreated $event)
    {
        $database= $event->getDatabase(); 
            Artisan::call('tenant:migration',[
            'database' => $database,
        ]);
    }
}
