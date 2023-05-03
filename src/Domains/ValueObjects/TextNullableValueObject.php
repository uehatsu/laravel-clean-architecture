<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

/**
 * TextNullableValueObject abstract class
 */
abstract class TextNullableValueObject implements ValueObjectCore
{
    /**
     * @param string|null $value
     */
    public function __construct(
        private ?string $value,
    ) {
        if (empty($this->value)) {
            $this->value = null;
        }
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param static $other
     * @return bool
     */
    public function equals($other): bool
    {
        return $other instanceof static && (
                (is_null($this->value) && is_null($other->getValue())) ||
                ($this->value === $other->getValue())
            );
    }
}
