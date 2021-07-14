<?php


namespace ThreeDevs\ValidatorTests\unit;

use PHPUnit\Framework\TestCase;
use ThreeDevs\validator\ValidationLanguage;
use ThreeDevs\validator\validator;
use ThreeDevs\validator\validators\arrays\ArrayHasNotNullKey;
use ThreeDevs\validator\validators\arrays\IsInArray;
use ThreeDevs\validator\validators\common\IsRequired;
use ThreeDevs\validator\validators\mobile\IsBdMobile;
use ThreeDevs\validator\validators\string\comparison\IsLengthSmallerThan;

class ApplicationTest extends TestCase
{
    public function testAppCanBeInitialized()
    {
        self::assertInstanceOf(Validator::class, new Validator([],[]));
    }
    public function testErrorWithArray()
    {
        $data = [
            'first_name' => '',
            'last_name' => '',
            'user_mobile' => '',
            'user_status' => 'active',
            'user_role' => 'gsm',
        ];
        $roles = ['nsm' => 'NSM', 'gsm' => 'GSM'];
        $validator = new Validator($data);
        $validator->add_validation(new IsRequired(),['first_name','last_name','user_mobile','user_status','user_role']);
        $validator->add_validation(new IsLengthSmallerThan(null, 100), ['first_name','last_name']);
        $validator->add_validation(new IsBdMobile(), ['user_mobile']);
        $validator->add_validation(new IsInArray(null, ['active', 'inactive'], false), ['user_status']);
        $validator->add_validation(new ArrayHasNotNullKey(null, $roles), ['user_role']);
        $validator->validate();

        $receivedMessages = $validator->getErrorMessages();

        $expectedMessages = [
            vsprintf(ValidationLanguage::getText('IsRequired'), ['first_name']),
            vsprintf(ValidationLanguage::getText('IsRequired'), ['last_name']),
            vsprintf(ValidationLanguage::getText('IsRequired'), ['user_mobile']),
            vsprintf(ValidationLanguage::getText('IsBdMobile'), ['user_mobile']),
        ];

        self::assertSame($expectedMessages, $receivedMessages);
        self::assertTrue($validator->isError());
    }
    public function testSuccessWithArray()
    {
        $data = [
            'first_name' => 'A',
            'last_name' => 'B',
            'user_status' => 'active',
            'user_role' => 'gsm',
        ];
        $roles = ['nsm' => 'NSM', 'gsm' => 'GSM'];
        $validator = new Validator($data);
        $validator->add_validation(new IsRequired(),['first_name','last_name','user_status','user_role']);
        $validator->add_validation(new IsLengthSmallerThan(null, 100), ['first_name','last_name']);
        $validator->add_validation(new IsInArray(null, ['active', 'inactive'], false), ['user_status']);
        $validator->add_validation(new ArrayHasNotNullKey(null, $roles), ['user_role']);
        $validator->validate();

        $receivedMessages = $validator->getErrorMessages();

        $expectedMessages = [];

        self::assertSame($expectedMessages, $receivedMessages);
        self::assertFalse($validator->isError());
    }
}