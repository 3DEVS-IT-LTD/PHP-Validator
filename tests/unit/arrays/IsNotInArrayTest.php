<?php


namespace ThreeDevs\ValidatorTests\unit\arrays;

use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\arrays\IsArray;
use ThreeDevs\validator\validators\arrays\IsInArray;
use ThreeDevs\validator\validators\arrays\IsNotInArray;
use ThreeDevs\validator\validators\number\IsInteger;

class IsNotInArrayTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider DataGenerator
     * @param mixed $data
     * @param bool $expected
     * @param array $haystack
     * @param bool $is_strict
     */
    public function testWithData($data, bool $expected, array $haystack, bool $is_strict = false){
        $validator = new Validator(['user_id' => $data]);
        $validator->add_validation((new IsNotInArray($data, $haystack, $is_strict)), ['user_id']);

        self::assertSame($expected, $validator->validate());
    }

    public function DataGenerator()
    {
        return [
            ['1', true, []],
            [1, true, []],
            [5, false, [1,4,5]],
            [5, false, [1,4,'5']],
            [5, true, [1,4,'5'], true],
            ['5', false, [1,4,'5']],
            ['5', false, [1,4,5]],
            ['5', true, [1,4,5], true],
            [true, false, [true]],
            [true, false, [1]],
            [true, true, [1], true],
            [false, false, [false]],
            [false, false, [0]],
            [false, true, [0], true],
            [null, false, [null]],
            [null, true, []],
            [null, false, [0]],
            [null, true, [0], true],
        ];
    }
}