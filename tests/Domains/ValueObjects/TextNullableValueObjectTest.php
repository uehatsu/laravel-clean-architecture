<?php
declare(strict_types=1);

namespace Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects;

use Uehatsu\LaravelCleanArchitecture\Test\Domains\ValueObjects\Mocks\TextNullableValueObjectMock;
use Uehatsu\LaravelCleanArchitecture\Test\TestCase;

class TextNullableValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function testObjectIsInstanceOfTextNotNUllValueObject(): void
    {
        $sut = new TextNullableValueObjectMock('test');

        $this->assertInstanceOf(TextNullableValueObjectMock::class, $sut);
    }

    /**
     * @return void
     */
    public function testObjectReturnsCorrectValue(): void
    {
        $value = 'test';

        $sut = new TextNullableValueObjectMock($value);

        $this->assertSame($value, $sut->getValue());
    }

    /**
     * @return void
     */
    public function testObjectCreationNotThrowsExceptionWith0LengthString(): void
    {
        $value = '';

        $sut = new TextNullableValueObjectMock($value);

        $this->assertNull($sut->getValue());
    }

    /**
     * @return void
     */
    public function testObjectCreationNotThrowsExceptionWithNull(): void
    {
        $value = null;

        $sut = new TextNullableValueObjectMock($value);

        $this->assertNull($sut->getValue());
    }

    /**
     * @return void
     */
    public function testEqualsReturnTrueValueWithSameObjects(): void
    {
        $value = 'TEST';

        $sut = new TextNullableValueObjectMock($value);

        $this->assertTrue($sut->equals($sut));
    }

    /**
     * @return void
     */
    public function testEqualsReturnTrueValueWithSameValueObjects(): void
    {
        $value = 'TEST';

        $sut1 = new TextNullableValueObjectMock($value);
        $sut2 = new TextNullableValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     */
    public function testEqualsReturnTrueValueWithSameNullValueObjects(): void
    {
        $value = null;

        $sut1 = new TextNullableValueObjectMock($value);
        $sut2 = new TextNullableValueObjectMock($value);

        $this->assertTrue($sut1->equals($sut2));
        $this->assertTrue($sut2->equals($sut1));
    }

    /**
     * @return void
     */
    public function testEqualsReturnFalseValueWithNotSameObjects1(): void
    {
        $value1 = 'TEST1';
        $value2 = 'TEST2';

        $sut1 = new TextNullableValueObjectMock($value1);
        $sut2 = new TextNullableValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }

    /**
     * @return void
     */
    public function testEqualsReturnFalseValueWithNotSameObjects2(): void
    {
        $value1 = 'TEST1';
        $value2 = null;

        $sut1 = new TextNullableValueObjectMock($value1);
        $sut2 = new TextNullableValueObjectMock($value2);

        $this->assertFalse($sut1->equals($sut2));
        $this->assertFalse($sut2->equals($sut1));
    }
}
