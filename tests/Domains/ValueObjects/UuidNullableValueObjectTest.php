<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Symfony\Component\Uid\Uuid;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\UuidNullableValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class UuidNullableValueObjectTest extends TestCase
{
    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectIsInstanceOfUuidNotNUllValueObject(): void
    {
        $value = Uuid::v4();

        $sut = new UuidNullableValueObjectMock($value);

        $this->assertInstanceOf(UuidNullableValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithUuidObject(): void
    {
        $value = Uuid::v4();

        $sut = new UuidNullableValueObjectMock($value);

        $this->assertTrue($value->equals($sut->getValue()));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithUuidString(): void
    {
        $uuid = Uuid::v4();
        $value = (string)$uuid;

        $sut = new UuidNullableValueObjectMock($value);

        $this->assertTrue($uuid->equals($sut->getValue()));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithNull(): void
    {
        $value = null;

        $sut = new UuidNullableValueObjectMock($value);

        $this->assertNull($sut->getValue());
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWith256LengthString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('The UuidNullableValueObject must be null or a valid Uuid.');

        $value = 'NG';

        new UuidNullableValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = Uuid::v4();

        $sut = new UuidNullableValueObjectMock($value);

        $this->assertTrue($sut->eq($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameNullObjects(): void
    {
        $value = null;

        $sut = new UuidNullableValueObjectMock($value);

        $this->assertTrue($sut->eq($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = Uuid::v4();

        $sut1 = new UuidNullableValueObjectMock($value);
        $sut2 = new UuidNullableValueObjectMock($value);

        $this->assertTrue($sut1->eq($sut2));
        $this->assertTrue($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithOtherNullValueObjects(): void
    {
        $value = null;

        $sut1 = new UuidNullableValueObjectMock($value);
        $sut2 = new UuidNullableValueObjectMock($value);

        $this->assertTrue($sut1->eq($sut2));
        $this->assertTrue($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects1(): void
    {
        $value1 = Uuid::v4();
        $value2 = Uuid::v4();

        $sut1 = new UuidNullableValueObjectMock($value1);
        $sut2 = new UuidNullableValueObjectMock($value2);

        $this->assertFalse($sut1->eq($sut2));
        $this->assertFalse($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects2(): void
    {
        $value1 = Uuid::v4();
        $value2 = null;

        $sut1 = new UuidNullableValueObjectMock($value1);
        $sut2 = new UuidNullableValueObjectMock($value2);

        $this->assertFalse($sut1->eq($sut2));
        $this->assertFalse($sut2->eq($sut1));
    }
}
