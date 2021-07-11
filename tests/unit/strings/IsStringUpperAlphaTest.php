<?php


namespace ThreeDevs\ValidatorTests\unit\strings;


use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\string\IsString;
use ThreeDevs\validator\validators\string\IsStringAlpha;
use ThreeDevs\validator\validators\string\IsStringUpperAlpha;

class IsStringUpperAlphaTest extends \PHPUnit\Framework\TestCase
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
        $validator->add_validation((new IsStringUpperAlpha($data, $allow_space, $allow_dot)), ['username']);

        self::assertSame($expected, $validator->validate());
    }

    public function DataGenerator(){
        return [
            ['', true],
            ['tanmay', false],
            ['tanmay chakrabarty', false],
            ['tanmay chakrabarty', false, true],
            ['tanmay.chakrabarty', false, true],
            ['tanmay.chakrabarty', false, true, true],
            ['TANMAY', true],
            ['TANMAY CHAKRABARTY', false],
            ['TANMAY CHAKRABARTY', true, true],
            ['TANMAY.CHAKRABARTY', false, true],
            ['TANMAY.CHAKRABARTY', true, true, true],
            [5, false],
            [5.5, false],
            [null, false],
            [true, false],
            [false, false],
        ];
    }
}