<?php


namespace ThreeDevs\ValidatorTests\unit;

use PHPUnit\Framework\TestCase;
use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\common\IsRequired;

class IsRequiredTest extends TestCase
{
    /**
     * @dataProvider IsRequiredDataGenerator
     * @param mixed $data
     * @param bool $expected
     */
    public function testIsRequiredWithData($data, bool $expected){
        $validator = new Validator(['username' => $data]);
        $validator->add_validation((new IsRequired()), ['username']);

        self::assertSame($expected, $validator->validate());
    }

    public function IsRequiredDataGenerator(){
        return [
            ['', false],
            ['tanmay', true],
            [5, true],
            [5.5, true],
            [null, false],
            [true, true],
            [false, true],
        ];
    }
}