<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Carbon\Carbon;
use DateTime;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\CarbonNullableValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class CarbonNullableValueObjectTest extends TestCase
{
    private mixed $originalTimezone;

    protected function setUp(): void
    {
        parent::setUp();

        $this->originalTimezone = config('app.timezone');

        config(['app.timezone' => 'Asia/Tokyo']);
    }

    protected function tearDown(): void
    {
        config(['app.timezone' => $this->originalTimezone]);

        parent::tearDown();
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectIsInstanceOfCarbonNotNUllValueObject(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut = new CarbonNullableValueObjectMock($value);

        $this->assertInstanceOf(CarbonNullableValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithStringDateTime(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut = new CarbonNullableValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($value));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithDateTimeObject(): void
    {
        $value = new DateTime('2023-01-01 00:00:00+09:00');

        $sut = new CarbonNullableValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($value));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithCarbonObject(): void
    {
        $value = Carbon::parse('2023-01-01 00:00:00+09:00');

        $sut = new CarbonNullableValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($value));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithNull(): void
    {
        $value = null;

        $sut = new CarbonNullableValueObjectMock($value);

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
        $this->expectExceptionMessage(
            'The CarbonNullableValueObject should either be null or a valid date and time value.'
        );

        $value = 'NG';

        new CarbonNullableValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut = new CarbonNullableValueObjectMock($value);

        $this->assertTrue($sut->equals($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut1 = new CarbonNullableValueObjectMock($value);
        $sut2 = new CarbonNullableValueObjectMock($value);

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

        $sut1 = new CarbonNullableValueObjectMock($value);
        $sut2 = new CarbonNullableValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects1(): void
    {
        $value1 = '2023-01-01 00:00:00+09:00';
        $value2 = '2023-01-02 00:00:00+09:00';

        $sut1 = new CarbonNullableValueObjectMock($value1);
        $sut2 = new CarbonNullableValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects2(): void
    {
        $value1 = '2023-01-01 00:00:00+09:00';
        $value2 = null;

        $sut1 = new CarbonNullableValueObjectMock($value1);
        $sut2 = new CarbonNullableValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }
}
