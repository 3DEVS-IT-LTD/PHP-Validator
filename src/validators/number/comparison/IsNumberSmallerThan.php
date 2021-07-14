<?php


namespace ThreeDevs\validator\validators\number\comparison;


use ThreeDevs\validator\validators\number\IsFloat;
use ThreeDevs\validator\validators\number\IsInteger;
use ThreeDevs\validator\validators\number\IsNumber;

class IsNumberSmallerThan extends \ThreeDevs\validator\Validation
{
    private float $length = 0;
    private bool $inclusive = true;
    private int $number_type = 0;
    const NUMBER = 0;
    const INTEGER_NUMBER = 1;
    const FLOAT_NUMBER = 2;

    public function __construct($data = null, float $length, bool $inclusive = true, int $number_type = self::NUMBER)
    {
        parent::__construct($data);
        $this->length = $length;
        $this->inclusive = $inclusive;
        $this->number_type = $number_type;
    }

    public function validate(): bool
    {
        switch ($this->number_type){
            case self::NUMBER:
                $ret = (new IsNumber($this->getData()))->validate();
                break;
            case self::INTEGER_NUMBER:
                $ret = (new IsInteger($this->getData()))->validate();
                break;
            case self::FLOAT_NUMBER:
                $ret = (new IsFloat($this->getData()))->validate();
                break;
            default:
                $ret = false;
                break;
        }

        if($ret){
            $ret = ($this->inclusive ? $this->getData() <= $this->length : $this->getData() < $this->length);
        }

        if(!$ret)
            $this->processError('IsNumberSmallerThan', [$this->getLabel(), $this->length]);

        return $ret;
    }
}