<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Symfony\Component\Uid\Ulid;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\UlidNullableValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class UlidNullableValueObjectTest extends TestCase
{
    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectIsInstanceOfUlidNotNUllValueObject(): void
    {
        $value = new Ulid();

        $sut = new UlidNullableValueObjectMock($value);

        $this->assertInstanceOf(UlidNullableValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithUlidObject(): void
    {
        $value = new Ulid();

        $sut = new UlidNullableValueObjectMock($value);

        $this->assertTrue($value->equals($sut->getValue()));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithUlidString(): void
    {
        $ulid = new Ulid();
        $value = $ulid->jsonSerialize();

        $sut = new UlidNullableValueObjectMock($value);

        $this->assertTrue($ulid->equals($sut->getValue()));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithNull(): void
    {
        $value = null;

        $sut = new UlidNullableValueObjectMock($value);

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
        $this->expectExceptionMessage('The UlidNullableValueObject must be null or a valid Ulid.');

        $value = 'NG';

        new UlidNullableValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = new Ulid();

        $sut = new UlidNullableValueObjectMock($value);

        $this->assertTrue($sut->eq($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameNullObjects(): void
    {
        $value = null;

        $sut = new UlidNullableValueObjectMock($value);

        $this->assertTrue($sut->eq($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = new Ulid();

        $sut1 = new UlidNullableValueObjectMock($value);
        $sut2 = new UlidNullableValueObjectMock($value);

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

        $sut1 = new UlidNullableValueObjectMock($value);
        $sut2 = new UlidNullableValueObjectMock($value);

        $this->assertTrue($sut1->eq($sut2));
        $this->assertTrue($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects1(): void
    {
        $value1 = new Ulid();
        $value2 = new Ulid();

        $sut1 = new UlidNullableValueObjectMock($value1);
        $sut2 = new UlidNullableValueObjectMock($value2);

        $this->assertFalse($sut1->eq($sut2));
        $this->assertFalse($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects2(): void
    {
        $value1 = new Ulid();
        $value2 = null;

        $sut1 = new UlidNullableValueObjectMock($value1);
        $sut2 = new UlidNullableValueObjectMock($value2);

        $this->assertFalse($sut1->eq($sut2));
        $this->assertFalse($sut2->eq($sut1));
    }
}
