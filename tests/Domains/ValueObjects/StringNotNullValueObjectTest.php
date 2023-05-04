<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\StringNotNullValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class StringNotNullValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function testObjectIsInstanceOfStringNotNUllValueObject(): void
    {
        $sut = new StringNotNullValueObjectMock('test');

        $this->assertInstanceOf(StringNotNullValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValue(): void
    {
        $value = 'test';

        $sut = new StringNotNullValueObjectMock($value);

        $this->assertSame($value, $sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationNotThrowsExceptionWith255LengthString(): void
    {
        $value = str_repeat('x', 255);

        $sut = new StringNotNullValueObjectMock($value);

        $this->assertSame($value, $sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWith0LengthString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'The StringNotNullValueObject must be at least 1 character and no more than 255 characters long.'
        );

        $value = '';

        new StringNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWith256LengthString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'The StringNotNullValueObject must be at least 1 character and no more than 255 characters long.'
        );

        $value = str_repeat('x', 256);

        new StringNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = 'TEST';

        $sut = new StringNotNullValueObjectMock($value);

        $this->assertTrue($sut->equals($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = 'TEST';

        $sut1 = new StringNotNullValueObjectMock($value);
        $sut2 = new StringNotNullValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects(): void
    {
        $value1 = 'TEST1';
        $value2 = 'TEST2';

        $sut1 = new StringNotNullValueObjectMock($value1);
        $sut2 = new StringNotNullValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }
}
