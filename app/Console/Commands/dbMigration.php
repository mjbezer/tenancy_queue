<?php

namespace AtitudeAgenda\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Artisan;


class dbMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ag:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a tables Atitude Agenda';

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
        Artisan::call('migrate');

    }
}
