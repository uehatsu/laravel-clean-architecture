<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

/**
 * StringNullableValueObject abstract class
 */
abstract class StringNullableValueObject implements ValueObjectCore
{
    private ?string $value;
    protected static string $name = 'StringNullableValueObject';
    protected static int $length = 255;

    /**
     * @param string|null $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        ?string $value,
    ) {
        $this->value = empty($value) ? null : $value;

        if (mb_strlen($this->value ?? '') > static::$length) {
            $message = trans(
                'uehatsu-lca::error.The :object must be null or between 0 and :length characters long.',
                ['object' => static::$name, 'length' => static::$length]
            );
            throw new InvalidArgumentException($message);
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
