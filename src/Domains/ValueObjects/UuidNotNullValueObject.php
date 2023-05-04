<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Symfony\Component\Uid\Uuid;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

/**
 * UuidNotNullValueObject abstract class
 */
abstract class UuidNotNullValueObject implements ValueObjectCore
{
    private Uuid $value;
    protected static string $name = 'UuidNotNullValueObject';

    /**
     * @param Uuid|string $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        Uuid|string $value,
    ) {
        if (is_string($value)) {
            if (Uuid::isValid($value)) {
                $this->value = Uuid::fromString($value);
            } else {
                $message = trans(
                    'uehatsu-lca::error.The :object must be a valid Uuid.',
                    ['object' => static::$name]
                );
                throw new InvalidArgumentException($message);
            }
        } else {
            $this->value = $value;
        }
    }

    /**
     * @return Uuid
     */
    public function getValue(): Uuid
    {
        return $this->value;
    }

    /**
     * @param static $other
     * @return bool
     */
    public function equals($other): bool
    {
        return $other instanceof static && $this->value->equals($other->getValue());
    }
}
