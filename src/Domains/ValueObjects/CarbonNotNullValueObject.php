<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Carbon\Carbon;
use DateTimeInterface;
use Exception;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

abstract class CarbonNotNullValueObject implements ValueObjectCore
{
    private Carbon $value;
    protected static string $name = 'CarbonNotNullValueObject';

    /**
     * @param DateTimeInterface|string $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        DateTimeInterface|string $value,
    ) {
        if (is_string($value)) {
            try {
                $this->value = Carbon::parse($value);
            } catch (Exception) {
                $message = trans(
                    'uehatsu-lca::error.The :object should be a valid date and time value.',
                    ['object' => static::$name]
                );
                throw new InvalidArgumentException($message);
            }
        } else {
            $this->value = new Carbon($value);
        }
    }

    public function getValue(): Carbon
    {
        return $this->value;
    }

    /**
     * @param static $other
     * @return bool
     */
    public function equals($other): bool
    {
        return $other instanceof static && $this->value->eq($other->getValue());
    }
}
