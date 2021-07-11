<?php


namespace ThreeDevs\ValidatorTests\unit\strings;


use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\string\IsString;
use ThreeDevs\validator\validators\string\IsStringAlpha;
use ThreeDevs\validator\validators\string\IsStringLowerAlpha;

class IsStringLowerAlphaTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider DataGenerator
     * @param mixed $data
     * @param bool $expected
     * @param bool $allow_space
     * @param bool $allow_dot
     */
    public function testIsStringAlphaWithData($data, bool $expected, bool $allow_space = false, bool $allow_dot = false){
        $validator = new Validator(['username' => $data]);
        $validator->add_validation((new IsStringLowerAlpha($data, $allow_space, $allow_dot)), ['username']);

        self::assertSame($expected, $validator->validate());
    }

    public function DataGenerator(){
        return [
            ['', true],
            ['tanmay', true],
            ['tanmay chakrabarty', false],
            ['tanmay chakrabarty', true, true],
            ['tanmay.chakrabarty', false, true],
            ['tanmay.chakrabarty', true, true, true],
            ['TANMAY', false],
            ['TANMAY CHAKRABARTY', false],
            ['TANMAY CHAKRABARTY', false, true],
            ['TANMAY.CHAKRABARTY', false, true],
            ['TANMAY.CHAKRABARTY', false, true, true],
            [5, false],
            [5.5, false],
            [null, false],
            [true, false],
            [false, false],
        ];
    }
}