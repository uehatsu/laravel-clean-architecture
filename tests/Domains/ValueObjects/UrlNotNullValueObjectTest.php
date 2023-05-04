<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\UrlNotNullValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class UrlNotNullValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function testObjectIsInstanceOfUrlNotNUllValueObject(): void
    {
        $sut = new UrlNotNullValueObjectMock('https://www.example.com/');

        $this->assertInstanceOf(UrlNotNullValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValue(): void
    {
        $value = 'https://www.example.com/';

        $sut = new UrlNotNullValueObjectMock($value);

        $this->assertSame($value, $sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationNotThrowsExceptionWithJapaneseString(): void
    {
        $value = 'https://www.example.com/wiki/これは日本語';
        $expected = 'https://www.example.com/wiki/' . urlencode('これは日本語');

        $sut = new UrlNotNullValueObjectMock($value);

        $this->assertSame($expected, $sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWith0LengthString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('The UrlNotNullValueObject must be a valid URL with at least 1 character.');

        $value = '';

        new UrlNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWithInvalidString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('The UrlNotNullValueObject must be a valid URL with at least 1 character.');

        $value = 'NG_STRING';

        new UrlNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = 'https://www.example.com/';

        $sut = new UrlNotNullValueObjectMock($value);

        $this->assertTrue($sut->eq($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = 'https://www.example.com/';

        $sut1 = new UrlNotNullValueObjectMock($value);
        $sut2 = new UrlNotNullValueObjectMock($value);

        $this->assertTrue($sut1->eq($sut2));
        $this->assertTrue($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects(): void
    {
        $value1 = 'https://www.example.com/aaa/';
        $value2 = 'https://www.example.com/bbb/';

        $sut1 = new UrlNotNullValueObjectMock($value1);
        $sut2 = new UrlNotNullValueObjectMock($value2);

        $this->assertFalse($sut1->eq($sut2));
        $this->assertFalse($sut2->eq($sut1));
    }
}
