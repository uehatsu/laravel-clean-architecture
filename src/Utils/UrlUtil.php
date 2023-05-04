<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Utils;

/**
 * Url Util class
 */
class UrlUtil
{
    /**
     * @param string $url
     * @return string
     */
    public static function mb_urlencode(string $url): string
    {
        $callback = function ($matches) {
            return rawurlencode($matches[0]);
        };
        return preg_replace_callback('/[^\x21-\x7e]+/', $callback, $url);
    }
}
