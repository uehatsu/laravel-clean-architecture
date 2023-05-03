<?php
declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Exceptions\InvalidArgumentException;
use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\TextNotNullValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class TextNotNullValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function testObjectIsInstanceOfTextNotNUllValueObject(): void
    {
        $sut = new TextNotNullValueObjectMock('test');

        $this->assertInstanceOf(TextNotNullValueObjectMock::class, $sut);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testObjectReturnsCorrectValue(): void
    {
        $value = 'test';

        $sut = new TextNotNullValueObjectMock($value);

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
        $this->expectExceptionMessage('The TextNotNullValueObject must be at least 1 character long.');

        $value = '';

        new TextNotNullValueObjectMock($value);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = 'TEST';

        $sut = new TextNotNullValueObjectMock($value);

        $this->assertTrue($sut->equals($sut));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = 'TEST';

        $sut1 = new TextNotNullValueObjectMock($value);
        $sut2 = new TextNotNullValueObjectMock($value);

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

        $sut1 = new TextNotNullValueObjectMock($value1);
        $sut2 = new TextNotNullValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }
}
