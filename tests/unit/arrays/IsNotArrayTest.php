<?php


namespace ThreeDevs\ValidatorTests\unit\arrays;

use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\arrays\IsArray;
use ThreeDevs\validator\validators\arrays\IsNotArray;
use ThreeDevs\validator\validators\number\IsInteger;

class IsNotArrayTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider DataGenerator
     * @param mixed $data
     * @param bool $expected
     */
    public function testWithData($data, bool $expected){
        $validator = new Validator(['user_id' => $data]);
        $validator->add_validation((new IsNotArray()), ['user_id']);

        self::assertSame($expected, $validator->validate());
    }

    public function DataGenerator()
    {
        return [
            ['1', true],
            [1, true],
            [[], false],
            [['a', 'b'], false],
            [['a' => 'b'], false],
            [true, true],
            [false, true],
            [null, true],
        ];
    }
}