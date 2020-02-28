<?php

namespace AtitudeAgenda\Console\Commands;

use AtitudeAgenda\User;
use Illuminate\Console\Command;
use AtitudeAgenda\Tenant\TenantManager;
use Illuminate\Support\Facades\Artisan;

class ClientMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migration {database?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migrations Tenants';
    private $tenant;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TenantManager $tenant) 
    {
        parent::__construct();

        $this->tenant = $tenant;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('database')) {
            $this->execCommand($this->argument('database'));
           
        } else {
                $datadases = User::all();
                foreach ($datadases as $database) {
                  $this->execCommand($database->banco_dados);                     
                }
            }
    }

    public function execCommand($database)
    {
        $this->tenant->setConnection($database);
        $this->info('Conectando no Schema '. $database);
        Artisan::call('migrate', [
            '--force'=> true,
            '--path' =>'/database/migrations',  
        ]);
        $this->info(Artisan::output());
        $this->info('Desconectando Schema '. $database);

    }
}
