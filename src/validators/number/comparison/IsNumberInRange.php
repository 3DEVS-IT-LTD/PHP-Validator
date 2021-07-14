<?php


namespace ThreeDevs\validator\validators\number\comparison;


use ThreeDevs\validator\validators\number\IsFloat;
use ThreeDevs\validator\validators\number\IsInteger;
use ThreeDevs\validator\validators\number\IsNumber;

class IsNumberInRange extends \ThreeDevs\validator\Validation
{
    private float $lower_bound = 0;
    private float $upper_bound = 0;
    private bool $inclusive = true;
    private int $number_type = 0;
    const NUMBER = 0;
    const INTEGER_NUMBER = 1;
    const FLOAT_NUMBER = 2;

    public function __construct($data = null, float $lower_bound, float $upper_bound, bool $inclusive = true, int $number_type = self::NUMBER)
    {
        parent::__construct($data);
        $this->lower_bound = $lower_bound;
        $this->upper_bound = $upper_bound;
        $this->inclusive = $inclusive;
        $this->number_type = $number_type;
    }

    protected function work(): bool
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
            if($this->inclusive)
                $ret = $this->getData() >= $this->lower_bound && $this->getData() <= $this->upper_bound;
            else
                $ret = $this->getData() > $this->lower_bound && $this->getData() < $this->upper_bound;
        }

        if(!$ret)
            $this->processError('IsNumberInRange', [$this->getLabel(), $this->lower_bound, $this->upper_bound, ($this->inclusive ? 'inclusive' : 'exclusive')]);

        return $ret;
    }
}