<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Carbon\Carbon;
use DateTimeInterface;
use Exception;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

/**
 * CarbonDateNotNullValueObject abstract class
 */
abstract class CarbonDateNotNullValueObject implements ValueObjectCore
{
    private Carbon $value;
    protected static string $name = 'CarbonDateNotNullValueObject';

    /**
     * @param DateTimeInterface|string $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        DateTimeInterface|string $value,
    ) {
        if (is_string($value)) {
            try {
                $tmp = Carbon::parse($value);
            } catch (Exception) {
                $message = trans(
                    'uehatsu-lca::error.The :object should be a valid date and time value.',
                    ['object' => static::$name]
                );
                throw new InvalidArgumentException($message);
            }
        } else {
            $tmp = new Carbon($value);
        }

        $this->value = $tmp->timezone(config('app.timezone'))->startOfDay();
    }

    /**
     * @return Carbon
     */
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
