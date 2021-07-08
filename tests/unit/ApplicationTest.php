<?php


namespace ThreeDevs\ValidatorTests\unit;

use PHPUnit\Framework\TestCase;
use ThreeDevs\validator\validator;

class ApplicationTest extends TestCase
{
    public function testAppCanBeInitialized()
    {
        self::assertInstanceOf(Validator::class, new Validator([],[]));
    }
}