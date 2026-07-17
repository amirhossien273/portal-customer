<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use App\Queue\UuidFailedJobProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // The customer-facing portal is intentionally independent from the
        // company portal's tenant context.
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app['config']->get('queue.failed.driver') === 'database-uuids') {
            $this->app->singleton('queue.failer', fn ($app) => new UuidFailedJobProvider(
                $app['db'],
                $app['config']->get('queue.failed.database'),
                $app['config']->get('queue.failed.table')
            ));
        }

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

    }
}
