<?php
declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

interface ValueObjectCore
{
    public function getValue();

    public function equals(ValueObjectCore $other): bool;
}