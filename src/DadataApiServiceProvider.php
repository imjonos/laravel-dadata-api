<?php

declare(strict_types=1);

namespace Nos\DadataApi;

use Illuminate\Support\ServiceProvider;

class DadataApiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dadataapi.php',
            'dadataapi'
        );

        $this->app->singleton('dadataapi', static fn(): DadataApi => new DadataApi());
    }

    /**
     * @return array<string>
     */
    public function provides(): array
    {
        return ['dadataapi'];
    }

    protected function bootForConsole(): void
    {
        $this->publishes([
            __DIR__ . '/../config/dadataapi.php' => config_path('dadataapi.php'),
        ], 'dadataapi.config');
    }
}