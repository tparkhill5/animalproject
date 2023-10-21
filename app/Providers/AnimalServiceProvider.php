<?php

namespace App\Providers;

use App\Services\AnimalService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class AnimalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AnimalService::class, function (Application $app) {
            return new AnimalService();
        });

        $this->app->singleton(AnimalMsgService::class, function (Application $app) {
            return new AnimalMsgService();
        });
    }
}
