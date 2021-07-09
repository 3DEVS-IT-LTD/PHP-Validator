<?php


namespace ThreeDevs\ValidatorTests\unit;


use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\datetime\IsDateTime;

class IsDateTimeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider IsDateTimeDataGenerator
     * @param mixed $data
     * @param string $format
     * @param bool $expected
     */
    public function testIsDateWithData($data, bool $expected, string $format = 'Y-m-d H:i:s'){
        $validator = new Validator(['create_datetime' => $data]);
        $validator->add_validation((new IsDateTime($data, $format)), ['create_datetime']);

        self::assertSame($expected, $validator->validate());
    }

    public function IsDateTimeDataGenerator(){
        return [
            ['', false],
            ['2021-06-07', true, 'Y-m-d'],
            ['2021-06-07 12:45:45', true, 'Y-m-d h:i:s'],
            ['2021-06-07 12:45:65', false, 'Y-m-d H:i:s'],
            ['07-06-2021', true, 'd-m-Y'],
            [5, false],
            [5.5, false],
            [null, false],
            [true, false],
            [false, false],
        ];
    }
}