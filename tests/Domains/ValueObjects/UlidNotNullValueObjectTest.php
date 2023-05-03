<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Symfony\Component\Uid\Ulid;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\UlidNotNullValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class UlidNotNullValueObjectTest extends TestCase
{
    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectIsInstanceOfUlidNotNUllValueObject(): void
    {
        $value = new Ulid();

        $sut = new UlidNotNullValueObjectMock($value);

        $this->assertInstanceOf(UlidNotNullValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithUlidObject(): void
    {
        $value = new Ulid();

        $sut = new UlidNotNullValueObjectMock($value);

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

        $sut = new UlidNotNullValueObjectMock($value);

        $this->assertTrue($ulid->equals($sut->getValue()));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWith256LengthString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('The UlidNotNullValueObject must be a valid Ulid.');

        $value = 'NG';

        new UlidNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = new Ulid();

        $sut = new UlidNotNullValueObjectMock($value);

        $this->assertTrue($sut->equals($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = new Ulid();

        $sut1 = new UlidNotNullValueObjectMock($value);
        $sut2 = new UlidNotNullValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects(): void
    {
        $value1 = new Ulid();
        $value2 = new Ulid();

        $sut1 = new UlidNotNullValueObjectMock($value1);
        $sut2 = new UlidNotNullValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }
}
