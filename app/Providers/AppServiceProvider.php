<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Queue;
use Illuminate\Queue\Events\JobProcessed;
use Log;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::after(function (JobProcessed $event) {
            Log::info($event->data);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
//            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
//            $this->app->register(new Whoops\Provider\Silex\WhoopsServiceProvider);
        }
    }
}
