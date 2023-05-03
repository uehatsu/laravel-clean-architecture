<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

/**
 * StringNotNullValueObject abstract class
 */
abstract class StringNotNullValueObject implements ValueObjectCore
{
    protected static string $name = 'StringNotNullValueObject';
    protected static int $length = 255;

    /**
     * @param string $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        private string $value,
    ) {
        if (empty($this->value) || mb_strlen($this->value) > static::$length) {
            $message = trans(
                'uehatsu-lca::error.The :object must be at least 1 character and no more than :length characters long.',
                ['object' => static::$name, 'length' => static::$length]
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
    public function equals($other): bool
    {
        return $other instanceof static && ($this->value === $other->getValue());
    }
}
