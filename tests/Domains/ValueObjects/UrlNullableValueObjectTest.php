<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\UrlNullableValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class UrlNullableValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function testObjectIsInstanceOfUrlNotNUllValueObject(): void
    {
        $sut = new UrlNullableValueObjectMock('https://www.example.com/');

        $this->assertInstanceOf(UrlNullableValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValue(): void
    {
        $value = 'https://www.example.com/';

        $sut = new UrlNullableValueObjectMock($value);

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

        $sut = new UrlNullableValueObjectMock($value);

        $this->assertSame($expected, $sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWith0LengthString(): void
    {
        $value = '';

        $sut = new UrlNullableValueObjectMock($value);

        $this->assertNull($sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWithNull(): void
    {
        $value = null;

        $sut = new UrlNullableValueObjectMock($value);

        $this->assertNull($sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWithInvalidString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('The UrlNullableValueObject must be null or a valid URL.');

        $value = 'NG_STRING';

        new UrlNullableValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = 'https://www.example.com/';

        $sut = new UrlNullableValueObjectMock($value);

        $this->assertTrue($sut->equals($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = 'https://www.example.com/';

        $sut1 = new UrlNullableValueObjectMock($value);
        $sut2 = new UrlNullableValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameNullValueObjects(): void
    {
        $value = null;

        $sut1 = new UrlNullableValueObjectMock($value);
        $sut2 = new UrlNullableValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects1(): void
    {
        $value1 = 'https://www.example.com/aaa/';
        $value2 = 'https://www.example.com/bbb/';

        $sut1 = new UrlNullableValueObjectMock($value1);
        $sut2 = new UrlNullableValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects2(): void
    {
        $value1 = 'https://www.example.com/';
        $value2 = null;

        $sut1 = new UrlNullableValueObjectMock($value1);
        $sut2 = new UrlNullableValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }
}
