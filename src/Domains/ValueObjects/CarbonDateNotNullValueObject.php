<?php
declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Carbon\Carbon;
use DateTimeInterface;
use Exception;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

abstract class CarbonDateNotNullValueObject implements ValueObjectCore
{
    private Carbon $value;
    private static string $name = 'CarbonDateNotNullValueObject';

    /**
     * @param DateTimeInterface|string $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        DateTimeInterface|string $value,
    )
    {
        if (is_string($value)) {
            try {
                $tmp = Carbon::parse($value);
            } catch (Exception) {
                $message = trans('uehatsu-lca::error.:object must be a valid date and time.', ['object' => static::$name]);
                throw new InvalidArgumentException($message);
            }
        } else {
            $tmp = new Carbon($value);
        }

        $this->value = $tmp->timezone(config('app.timezone'))->startOfDay();
    }

    public function getValue(): Carbon
    {
        return $this->value;
    }

    public function equals(ValueObjectCore $other): bool
    {
        return $other instanceof static && $this->value->eq($other->getValue());
    }
}