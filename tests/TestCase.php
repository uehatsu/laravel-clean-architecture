<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Uehatsu\LaravelCleanArchitecture\LaravelPluginServiceProvider;

abstract class TestCase extends OrchestraTestCase
{

    protected function getPackageProviders($app): array
    {
        return [
            LaravelPluginServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
    }
}
