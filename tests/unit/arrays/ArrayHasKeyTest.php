<?php


namespace ThreeDevs\ValidatorTests\unit\arrays;

use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\arrays\ArrayHasKey;
use ThreeDevs\validator\validators\arrays\IsArray;
use ThreeDevs\validator\validators\number\IsInteger;

class ArrayHasKeyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider DataGenerator
     * @param mixed $data
     * @param bool $expected
     * @param array $the_array
     */
    public function testWithData($data, bool $expected, array $the_array){
        $validator = new Validator(['user_id' => $data]);
        $validator->add_validation((new ArrayHasKey($data, $the_array)), ['user_id']);

        self::assertSame($expected, $validator->validate());
    }

    public function DataGenerator()
    {
        return [
            ['1', false, []],
            [1, false, []],
            [5, false, [1,4,5]],
            [5, true, [1,4,'5',6,7,8]],
            [5, false, [0=>1,1=>4,2=>'5']],
            [5, true, [0=>1,1=>4,5=>'5']],
            [5, true, [0=>1,1=>4,'5'=>'5']],
            [true, false, [1,4,5]],
            [false, false, [1,4,5]],
            [null, false, [1,4,5]],
        ];
    }
}