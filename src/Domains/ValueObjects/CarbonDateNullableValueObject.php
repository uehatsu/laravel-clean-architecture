<?php
declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Carbon\Carbon;
use DateTimeInterface;
use Exception;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;

class CarbonDateNullableValueObject implements ValueObjectCore
{
    private ?Carbon $value;
    private static string $name = 'CarbonDateNullableValueObject';

    /**
     * @param DateTimeInterface|string|null $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        DateTimeInterface|string|null $value,
    )
    {
        if (empty($value)) {
            $tmp = null;
        } elseif (is_string($value)) {
            try {
                $tmp = Carbon::parse($value);
            } catch (Exception $e) {
                $message = trans('uehatsu-lca::error.The :object should either be null or a valid date and time value.', ['object' => static::$name]);
                throw new InvalidArgumentException($message);
            }
        } else {
            $tmp = new Carbon($value);
        }

        $this->value = $tmp?->timezone(config('app.timezone'))->startOfDay();
    }

    public function getValue(): ?Carbon
    {
        return $this->value;
    }

    public function equals(ValueObjectCore $other): bool
    {
        return $other instanceof static &&
            (
                (is_null($this->value) && is_null($other->getValue())) ||
                $this->value?->eq($other->getValue()) === true
            );
    }
}
