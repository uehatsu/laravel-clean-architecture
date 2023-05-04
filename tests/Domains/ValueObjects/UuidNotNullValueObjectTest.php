<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Symfony\Component\Uid\Uuid;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\UuidNotNullValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class UuidNotNullValueObjectTest extends TestCase
{
    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectIsInstanceOfUuidNotNUllValueObject(): void
    {
        $value = Uuid::v4();

        $sut = new UuidNotNullValueObjectMock($value);

        $this->assertInstanceOf(UuidNotNullValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithUuidObject(): void
    {
        $value = Uuid::v4();

        $sut = new UuidNotNullValueObjectMock($value);

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

        $sut = new UuidNotNullValueObjectMock($value);

        $this->assertTrue($uuid->equals($sut->getValue()));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWith256LengthString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('The UuidNotNullValueObject must be a valid Uuid.');

        $value = 'NG';

        new UuidNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = Uuid::v4();

        $sut = new UuidNotNullValueObjectMock($value);

        $this->assertTrue($sut->equals($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = Uuid::v4();

        $sut1 = new UuidNotNullValueObjectMock($value);
        $sut2 = new UuidNotNullValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects(): void
    {
        $value1 = Uuid::v4();
        $value2 = Uuid::v4();

        $sut1 = new UuidNotNullValueObjectMock($value1);
        $sut2 = new UuidNotNullValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }
}
