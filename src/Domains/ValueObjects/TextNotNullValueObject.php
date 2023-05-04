<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

/**
 * TextNotNullValueObject abstract class
 */
abstract class TextNotNullValueObject implements ValueObjectCore
{
    protected static string $name = 'TextNotNullValueObject';

    /**
     * @param string $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        private string $value,
    ) {
        if (empty($this->value)) {
            $message = trans(
                'uehatsu-lca::error.The :object must be at least 1 character long.',
                ['object' => static::$name]
            );
            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param static $other
     * @return bool
     */
    public function eq($other): bool
    {
        return $other instanceof static && ($this->value === $other->getValue());
    }
}
