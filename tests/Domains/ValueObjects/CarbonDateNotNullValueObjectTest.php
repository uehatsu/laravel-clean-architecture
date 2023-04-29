<?php
declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Carbon\Carbon;
use DateTime;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;
use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\CarbonDateNotNullValueObjectMock;

class CarbonDateNotNullValueObjectTest extends TestCase
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
    public function testObjectIsInstanceOfCarbonDateNotNUllValueObject(): void
    {
        $value = '2023-01-01 12:00:00+09:00';

        $sut = new CarbonDateNotNullValueObjectMock($value);

        $this->assertInstanceOf(CarbonDateNotNullValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithStringDateTime(): void
    {
        $value = '2023-01-01 12:00:00+09:00';
        $expected = '2023-01-01 00:00:00+09:00';

        $sut = new CarbonDateNotNullValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($expected));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithDateTimeObject(): void
    {
        $value = new DateTime('2023-01-01 12:00:00+09:00');
        $expected = new DateTime('2023-01-01 00:00:00+09:00');

        $sut = new CarbonDateNotNullValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($expected));
    }


    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValueWithCarbonObject(): void
    {
        $value = Carbon::parse('2023-01-01 12:00:00+09:00');
        $expected = Carbon::parse('2023-01-01 00:00:00+09:00');

        $sut = new CarbonDateNotNullValueObjectMock($value);

        $this->assertTrue($sut->getValue()->eq($expected));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectCreationThrowsExceptionWithInvalidString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('CarbonDateNotNullValueObject must be a valid date and time.');

        $value = 'NG';

        new CarbonDateNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut = new CarbonDateNotNullValueObjectMock($value);

        $this->assertTrue($sut->equals($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = '2023-01-01 00:00:00+09:00';

        $sut1 = new CarbonDateNotNullValueObjectMock($value);
        $sut2 = new CarbonDateNotNullValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnFalseValueWithNotSameObjects(): void
    {
        $value1 = '2023-01-01 00:00:00+09:00';
        $value2 = '2023-01-02 00:00:00+09:00';

        $sut1 = new CarbonDateNotNullValueObjectMock($value1);
        $sut2 = new CarbonDateNotNullValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }
}
