<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\StringNullableValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class StringNullableValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function testObjectIsInstanceOfStringNotNUllValueObject(): void
    {
        $sut = new StringNullableValueObjectMock('test');

        $this->assertInstanceOf(StringNullableValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValue(): void
    {
        $value = 'test';

        $sut = new StringNullableValueObjectMock($value);

        $this->assertSame($value, $sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationNotThrowsExceptionWith255LengthString(): void
    {
        $value = str_repeat('x', 255);

        $sut = new StringNullableValueObjectMock($value);

        $this->assertSame($value, $sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationNotThrowsExceptionWith0LengthString(): void
    {
        $value = '';

        $sut = new StringNullableValueObjectMock($value);

        $this->assertNull($sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationNotThrowsExceptionWithNull(): void
    {
        $value = null;

        $sut = new StringNullableValueObjectMock($value);

        $this->assertSame($value, $sut->getValue());
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
            'The StringNullableValueObject must be null or between 0 and 255 characters long.'
        );

        $value = str_repeat('x', 256);

        new StringNullableValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = 'TEST';

        $sut = new StringNullableValueObjectMock($value);

        $this->assertTrue($sut->eq($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = 'TEST';

        $sut1 = new StringNullableValueObjectMock($value);
        $sut2 = new StringNullableValueObjectMock($value);

        $this->assertTrue($sut1->eq($sut2));
        $this->assertTrue($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameNullValueObjects(): void
    {
        $value = null;

        $sut1 = new StringNullableValueObjectMock($value);
        $sut2 = new StringNullableValueObjectMock($value);

        $this->assertTrue($sut1->eq($sut2));
        $this->assertTrue($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects1(): void
    {
        $value1 = 'TEST1';
        $value2 = 'TEST2';

        $sut1 = new StringNullableValueObjectMock($value1);
        $sut2 = new StringNullableValueObjectMock($value2);

        $this->assertFalse($sut1->eq($sut2));
        $this->assertFalse($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects2(): void
    {
        $value1 = 'TEST1';
        $value2 = null;

        $sut1 = new StringNullableValueObjectMock($value1);
        $sut2 = new StringNullableValueObjectMock($value2);

        $this->assertFalse($sut1->eq($sut2));
        $this->assertFalse($sut2->eq($sut1));
    }
}
