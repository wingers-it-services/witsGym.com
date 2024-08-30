<?php

namespace App\Providers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule)
    {
        $schedule->command('emails:send');
        //For Workout
        $schedule->command('user:workout')->dailyAt('00:01');
        //For Diet
        $schedule->command('user:diets')->dailyAt('00:01');

    }


}
