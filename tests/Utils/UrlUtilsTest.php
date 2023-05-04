<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Utils;

use Uehatsu\LaravelCleanArchitecture\Test\TestCase;
use Uehatsu\LaravelCleanArchitecture\Utils\UrlUtil;

class UrlUtilsTest extends TestCase
{
    public function testMbUrlencodeReturnsValidValueWithEnglishLetters(): void
    {
        $value = 'https://www.example.com/xxxxxxxxxxxxxxxxxxxxxx';

        $sut = UrlUtil::mb_urlencode($value);

        $this->assertSame($value, $sut);
    }

    public function testMbUrlencodeReturnsValidValueWithJapaneseLetters(): void
    {
        $value = 'https://www.example.com/wiki/これは日本語';
        $expected = 'https://www.example.com/wiki/' . urlencode('これは日本語');

        $sut = UrlUtil::mb_urlencode($value);

        $this->assertSame($expected, $sut);
    }
}
