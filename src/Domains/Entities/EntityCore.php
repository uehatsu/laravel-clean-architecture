<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\Entities;

/**
 * EntityCore Interface
 */
interface EntityCore
{
    /**
     * @template T of EntityCore
     * @param T $other
     * @return bool
     */
    public function eq($other): bool;
}
