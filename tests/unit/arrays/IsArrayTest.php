<?php


namespace ThreeDevs\ValidatorTests\unit\arrays;

use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\arrays\IsArray;
use ThreeDevs\validator\validators\number\IsInteger;

class IsArrayTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider DataGenerator
     * @param mixed $data
     * @param bool $expected
     */
    public function testWithData($data, bool $expected){
        $validator = new Validator(['user_id' => $data]);
        $validator->add_validation((new IsArray()), ['user_id']);

        self::assertSame($expected, $validator->validate());
    }

    public function DataGenerator()
    {
        return [
            ['1', false],
            [1, false],
            [[], true],
            [['a', 'b'], true],
            [['a' => 'b'], true],
            [true, false],
            [false, false],
            [null, false],
        ];
    }
}