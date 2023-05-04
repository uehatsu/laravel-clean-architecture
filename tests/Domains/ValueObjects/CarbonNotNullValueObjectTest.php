<?php

declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Carbon\Carbon;
use DateTime;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\CarbonNotNullValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class CarbonNotNullValueObjectTest extends TestCase
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

        $sut = new CarbonNotNullValueObjectMock($value);

        $this->assertInstanceOf(CarbonNotNullValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithStringDateTime(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut = new CarbonNotNullValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($value));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithDateTimeObject(): void
    {
        $value = new DateTime('2023-01-01 00:00:00+09:00');

        $sut = new CarbonNotNullValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($value));
    }


    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithCarbonObject(): void
    {
        $value = Carbon::parse('2023-01-01 00:00:00+09:00');

        $sut = new CarbonNotNullValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($value));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWithInvalidString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('The CarbonNotNullValueObject should be a valid date and time value.');

        $value = 'NG';

        new CarbonNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut = new CarbonNotNullValueObjectMock($value);

        $this->assertTrue($sut->eq($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut1 = new CarbonNotNullValueObjectMock($value);
        $sut2 = new CarbonNotNullValueObjectMock($value);

        $this->assertTrue($sut1->eq($sut2));
        $this->assertTrue($sut2->eq($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects(): void
    {
        $value1 = '2023-01-01 00:00:00+09:00';
        $value2 = '2023-01-02 00:00:00+09:00';

        $sut1 = new CarbonNotNullValueObjectMock($value1);
        $sut2 = new CarbonNotNullValueObjectMock($value2);

        $this->assertFalse($sut1->eq($sut2));
        $this->assertFalse($sut2->eq($sut1));
    }
}
