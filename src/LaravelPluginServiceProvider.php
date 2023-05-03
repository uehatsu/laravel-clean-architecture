<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture;

use Illuminate\Support\ServiceProvider;

class LaravelPluginServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', 'uehatsu-lca');
    }

    public function register(): void
    {
    }
}
