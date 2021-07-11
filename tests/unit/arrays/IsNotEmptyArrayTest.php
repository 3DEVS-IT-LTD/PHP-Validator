<?php


namespace ThreeDevs\ValidatorTests\unit\arrays;

use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\arrays\IsArray;
use ThreeDevs\validator\validators\arrays\IsEmptyArray;
use ThreeDevs\validator\validators\arrays\IsNonEmptyArray;
use ThreeDevs\validator\validators\number\IsInteger;

class IsNotEmptyArrayTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider DataGenerator
     * @param mixed $data
     * @param bool $expected
     */
    public function testWithData($data, bool $expected){
        $validator = new Validator(['user_id' => $data]);
        $validator->add_validation((new IsNonEmptyArray()), ['user_id']);

        self::assertSame($expected, $validator->validate());
    }

    public function DataGenerator()
    {
        return [
            ['1', false],
            [1, false],
            [[], false],
            [['a', 'b'], true],
            [['a' => 'b'], true],
            [true, false],
            [false, false],
            [null, false],
        ];
    }
}