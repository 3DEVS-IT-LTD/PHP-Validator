<?php


namespace ThreeDevs\validator\validators\string\comparison;


class IsLengthInRange extends \ThreeDevs\validator\Validation
{
    private int $lowerBound = 0;
    private int $upperBound = 0;
    private bool $inclusive = true;

    public function __construct($data = null, int $lowerBound, int $upperBound, bool $inclusive = true)
    {
        parent::__construct($data);
        $this->lowerBound = $lowerBound;
        $this->upperBound = $upperBound;
        $this->inclusive = $inclusive;
    }

    public function validate(): bool
    {
        if(is_string($this->getData())){
            $dataLength = mb_strlen($this->getData());
            if($this->inclusive)
                $ret = ($dataLength >= $this->lowerBound && $dataLength <= $this->upperBound);
            else
                $ret = ($dataLength > $this->lowerBound && $dataLength < $this->upperBound);
        }
        else
            $ret = false;

        if(!$ret)
            $this->processError('IsLengthInRange', [$this->getLabel()]);

        return $ret;
    }
}