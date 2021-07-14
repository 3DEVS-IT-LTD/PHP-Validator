<?php


namespace ThreeDevs\validator\validators\string\comparison;


class IsLengthSmallerThan extends \ThreeDevs\validator\Validation
{
    private int $length = 0;
    private bool $inclusive = true;

    public function __construct($data = null, int $length, bool $inclusive = true)
    {
        parent::__construct($data);
        $this->length = $length;
        $this->inclusive = $inclusive;
    }

    public function validate(): bool
    {
        if(is_string($this->getData())){
            $dataLength = mb_strlen($this->getData());
            if($this->inclusive)
                $ret = $dataLength <= $this->length;
            else
                $ret = $dataLength < $this->length;
        }
        else
            $ret = false;

        if(!$ret)
            $this->processError('IsLengthSmallerThan', [$this->getLabel(), $this->length]);

        return $ret;
    }
}