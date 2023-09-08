<?php

namespace App\Providers;

use App\Contracts\DatabaseService;
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
        //
    }
}
