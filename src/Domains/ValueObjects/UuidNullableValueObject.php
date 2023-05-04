<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Symfony\Component\Uid\Uuid;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

/**
 * UlidNullableValueObject abstract class
 */
abstract class UuidNullableValueObject implements ValueObjectCore
{
    private ?Uuid $value;
    protected static string $name = 'UuidNullableValueObject';

    /**
     * @param Uuid|string|null $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        Uuid|string|null $value,
    ) {
        if (is_null($value)) {
            $this->value = null;
        } elseif (is_string($value)) {
            if (Uuid::isValid($value)) {
                $this->value = Uuid::fromString($value);
            } else {
                $message = trans(
                    'uehatsu-lca::error.The :object must be null or a valid Uuid.',
                    ['object' => static::$name]
                );
                throw new InvalidArgumentException($message);
            }
        } else {
            $this->value = $value;
        }
    }

    /**
     * @return Uuid|null
     */
    public function getValue(): ?Uuid
    {
        return $this->value;
    }

    /**
     * @param static $other
     * @return bool
     */
    public function equals($other): bool
    {
        return $other instanceof static &&
            (
                (is_null($this->value) && is_null($other->getValue())) ||
                (!is_null($this->value) && $this->value->equals($other->getValue()))
            );
    }
}
