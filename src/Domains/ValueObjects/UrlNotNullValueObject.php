<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Utils\UrlUtil;

/**
 * UrlNotNullValueObject abstract class
 */
abstract class UrlNotNullValueObject implements ValueObjectCore
{
    private string $value;
    protected static string $name = 'UrlNotNullValueObject';

    /**
     * @param string $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $value,
    ) {
        $this->value = UrlUtil::mb_urlencode($value);

        if (empty($this->value) || !filter_var($this->value, FILTER_VALIDATE_URL)) {
            $message = trans(
                'uehatsu-lca::error.The :object must be a valid URL with at least 1 character.',
                ['object' => static::$name]
            );
            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param static $other
     * @return bool
     */
    public function eq($other): bool
    {
        return $other instanceof static && ($this->value === $other->getValue());
    }
}
