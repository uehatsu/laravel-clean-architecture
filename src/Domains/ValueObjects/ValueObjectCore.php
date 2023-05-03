<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

/**
 * ValueObjectCore interface
 */
interface ValueObjectCore
{
    /**
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * @template T of ValueObjectCore
     * @param T $other
     * @return bool
     */
    public function equals($other): bool;
}
