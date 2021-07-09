<?php


namespace ThreeDevs\ValidatorTests\unit;


use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\datetime\IsTime;

class IsTimeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider IsTimeDataGenerator
     * @param mixed $data
     * @param string $format
     * @param bool $expected
     */
    public function testIsTimeWithData($data, bool $expected, string $format = 'H:i:s'){
        $validator = new Validator(['create_time' => $data]);
        $validator->add_validation((new IsTime($data, $format)), ['create_time']);

        self::assertSame($expected, $validator->validate());
    }

    public function IsTimeDataGenerator(){
        return [
            ['', false],
            ['12:04:05', true],
            ['22:04:65', false],
            ['25:04:55', false],
            ['12-24-25', false],
            ['11:12 AM', false, 'h:i:s'],
            ['11:12 AM', true, 'h:i A'],
            [5.5, false],
            [null, false],
            [true, false],
            [false, false],
        ];
    }
}