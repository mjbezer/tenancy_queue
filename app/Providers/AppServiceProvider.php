<?php

namespace AtitudeAgenda\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        $this->app->bind('slack', static function () {
            return new \Maknz\Slack\Client(config('slack.webhook'), config('slack.settings'));
       });

        
    }
}
