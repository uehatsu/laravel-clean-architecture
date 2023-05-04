<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Utils\UrlUtil;

/**
 * UrlNullableValueObject abstract class
 */
abstract class UrlNullableValueObject implements ValueObjectCore
{
    private ?string $value;
    protected static string $name = 'UrlNullableValueObject';

    /**
     * @param string|null $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        ?string $value,
    ) {
        $this->value = UrlUtil::mb_urlencode($value ?? '');

        if (empty($this->value)) {
            $this->value = null;
        } elseif (!filter_var($this->value, FILTER_VALIDATE_URL)) {
            $message = trans(
                'uehatsu-lca::error.The :object must be null or a valid URL.',
                ['object' => static::$name]
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
    public function eq($other): bool
    {
        return $other instanceof static && (
                (is_null($this->value) && is_null($other->getValue())) ||
                ($this->value === $other->getValue())
            );
    }
}
