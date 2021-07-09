<?php


namespace ThreeDevs\ValidatorTests\unit;


use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\datetime\IsTime;
use ThreeDevs\validator\validators\mobile\IsBdMobile;

class IsBdMobileTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider IsBdMobileDataGenerator
     * @param mixed $data
     * @param string $format
     * @param bool $expected
     */
    public function testIsBdMobileWithData($data, bool $expected){
        $validator = new Validator(['mobile' => $data]);
        $validator->add_validation((new IsBdMobile($data)), ['mobile']);

        self::assertSame($expected, $validator->validate());
    }

    public function IsBdMobileDataGenerator(){
        return [
            ['', false],
            ['asdasd', false],
            ['01301548752', true],
            ['11354879658', false],
            [5.5, false],
            [null, false],
            [true, false],
            [false, false],
        ];
    }
}