<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Queue;
use Illuminate\Queue\Events\JobProcessed;
use Log;
use Illuminate\Support\Facades\App;

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
            Log::info($event->job->payload());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        if (App::environment('production')) {
            $this->app->alias('bugsnag.multi', \Illuminate\Contracts\Logging\Log::class);
            $this->app->alias('bugsnag.multi', \Psr\Log\LoggerInterface::class);
        }
    }
}
