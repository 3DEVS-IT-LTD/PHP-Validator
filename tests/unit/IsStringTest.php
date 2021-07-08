<?php


namespace ThreeDevs\ValidatorTests\unit;


use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\string\IsString;

class IsStringTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider IsStringDataGenerator
     * @param mixed $data
     * @param bool $expected
     */
    public function testIsStringWithData($data, bool $expected){
        $validator = new Validator(['username' => $data]);
        $validator->add_validation((new IsString()), ['username']);

        self::assertSame($expected, $validator->validate());
    }

    public function IsStringDataGenerator(){
        return [
            ['', true],
            ['tanmay', true],
            [5, false],
            [5.5, false],
            [null, false],
            [true, false],
            [false, false],
        ];
    }
}