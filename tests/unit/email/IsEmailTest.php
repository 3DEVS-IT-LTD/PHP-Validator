<?php


namespace ThreeDevs\ValidatorTests\unit\email;


use ThreeDevs\validator\Validator;
use ThreeDevs\validator\validators\datetime\IsTime;
use ThreeDevs\validator\validators\email\IsEmail;

class IsEmailTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider IsEmailDataGenerator
     * @param mixed $data
     * @param bool $expected
     */
    public function testIsTimeWithData($data, bool $expected){
        $validator = new Validator(['email' => $data]);
        $validator->add_validation((new IsEmail($data)), ['email']);

        self::assertSame($expected, $validator->validate());
    }

    public function IsEmailDataGenerator(){
        return [
            ['', false],
            ['@gmail.com', false],
            ['tanmay@.', false],
            ['tanmay@.com', false],
            ['tanmay@com.', false],
            ['tanmaycom@.', false],
            ['tanmay@gmail.com.', false],
            ['tanmay@gmail.com', true],
            [5.5, false],
            [null, false],
            [true, false],
            [false, false],
        ];
    }
}