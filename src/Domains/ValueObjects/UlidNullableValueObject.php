<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Symfony\Component\Uid\Ulid;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

/**
 * UlidNullableValueObject abstract class
 */
abstract class UlidNullableValueObject implements ValueObjectCore
{
    private ?Ulid $value;
    protected static string $name = 'UlidNullableValueObject';

    /**
     * @param Ulid|string|null $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        Ulid|string|null $value,
    ) {
        if (is_null($value)) {
            $this->value = null;
        } elseif (is_string($value)) {
            if (Ulid::isValid($value)) {
                $this->value = Ulid::fromString($value);
            } else {
                $message = trans(
                    'uehatsu-lca::error.The :object must be null or a valid Ulid.',
                    ['object' => static::$name]
                );
                throw new InvalidArgumentException($message);
            }
        } else {
            $this->value = $value;
        }
    }

    /**
     * @return Ulid|null
     */
    public function getValue(): ?Ulid
    {
        return $this->value;
    }

    /**
     * @param static $other
     * @return bool
     */
    public function eq($other): bool
    {
        return $other instanceof static &&
            (
                (is_null($this->value) && is_null($other->getValue())) ||
                (!is_null($this->value) && $this->value->equals($other->getValue()))
            );
    }
}
