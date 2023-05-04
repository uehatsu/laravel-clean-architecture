<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Symfony\Component\Uid\Ulid;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

/**
 * UlidNotNullValueObject abstract class
 */
abstract class UlidNotNullValueObject implements ValueObjectCore
{
    private Ulid $value;
    protected static string $name = 'UlidNotNullValueObject';

    /**
     * @param Ulid|string $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        Ulid|string $value,
    ) {
        if (is_string($value)) {
            if (Ulid::isValid($value)) {
                $this->value = Ulid::fromString($value);
            } else {
                $message = trans(
                    'uehatsu-lca::error.The :object must be a valid Ulid.',
                    ['object' => static::$name]
                );
                throw new InvalidArgumentException($message);
            }
        } else {
            $this->value = $value;
        }
    }

    /**
     * @return Ulid
     */
    public function getValue(): Ulid
    {
        return $this->value;
    }

    /**
     * @param static $other
     * @return bool
     */
    public function eq($other): bool
    {
        return $other instanceof static && $this->value->equals($other->getValue());
    }
}
