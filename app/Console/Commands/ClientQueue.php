<?php

namespace AtitudeAgenda\Console\Commands;

use AtitudeAgenda\User;
use Illuminate\Console\Command;
use AtitudeAgenda\Tenant\TenantManager;
use Illuminate\Support\Facades\Artisan;


class ClientQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:queue {database?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run queue as licensed logged in';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $licenciados = User::all();
            foreach ($licenciados as $licenciado) {
                TenantManager::setConnection($licenciado->banco_dados);
                //$this->info('Run licencied task : '. $licenciado->name);
                Artisan::call('queue:work',[
                    "--once" => true,
                    "database"
                ]);
                $this->info(Artisan::output());
              //  $this->info('Executed task : '. $licenciado->name);
        }
            
    }
}
