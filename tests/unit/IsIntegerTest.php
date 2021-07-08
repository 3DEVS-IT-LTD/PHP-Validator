<?php


namespace ThreeDevs\ValidatorTests\unit;

use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\number\IsInteger;

class IsIntegerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider IsIntegerDataGenerator
     * @param mixed $data
     * @param bool $expected
     */
    public function testIsIntegerWithData($data, bool $expected){
        $validator = new Validator(['user_id' => $data]);
        $validator->add_validation((new IsInteger()), ['user_id']);

        self::assertSame($expected, $validator->validate(), $data." is not integer");
    }

    public function IsIntegerDataGenerator()
    {
        return [
             ['5', true],
            [5.5, false],
            ['0', true],
            ['-0', false],
            ['00', false],
            ['05', false],
            ['-05', false],
            [50, true],
            [true, false],
            [false, false],
            [null, false],
        ];
    }
}