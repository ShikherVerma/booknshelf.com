<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\User;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Log;
use Queue;

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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
