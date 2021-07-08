<?php


namespace ThreeDevs\ValidatorTests\unit;


use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\date\IsDate;
use ThreeDevs\validator\validators\string\IsString;

class IsDateTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider IsDateDataGenerator
     * @param mixed $data
     * @param string $format
     * @param bool $expected
     */
    public function testIsDateWithData($data, bool $expected, string $format = 'Y-m-d'){
        $validator = new Validator(['birthdate' => $data]);
        $validator->add_validation((new IsDate($data, $format)), ['birthdate']);

        self::assertSame($expected, $validator->validate());
    }

    public function IsDateDataGenerator(){
        return [
            ['', false, 'Y-m-d'],
            ['2021-06-07', true, 'Y-m-d'],
            ['07-06-2021', true, 'd-m-Y'],
            [5, false],
            [5.5, false],
            [null, false],
            [true, false],
            [false, false],
        ];
    }
}