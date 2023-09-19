<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Fortify;
use App\Contracts\DatabaseService;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\ServiceProvider;
use App\Services\SupabaseDatabaseService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DatabaseService::class, function() {
            return new SupabaseDatabaseService(
                config('supabase.api_key'),
                config('supabase.url')
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Fortify::authenticateUsing(fn ($request) =>
            $request->email === config('credentials.email') && $request->password === config('credentials.password')
            ? User::first()
            : null
        );
    }
}
