<?php

namespace App\Providers;
// use App\Models\User;
use Illuminate\Support\ServiceProvider;
// use App\Observers\UserObserver;

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
    public function boot(): void
    {
        // User::observe(UserObserver::class);
    }
}
