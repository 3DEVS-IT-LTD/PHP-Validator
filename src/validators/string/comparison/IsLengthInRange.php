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

    protected function work(): bool
    {
        if(is_string($this->getData())){
            $dataLength = mb_strlen($this->getData());
            if($this->inclusive)
                $ret = ($dataLength >= $this->lowerBound && $dataLength <= $this->upperBound);
            else
                $ret = ($dataLength > $this->lowerBound && $dataLength < $this->upperBound);
        }
        else if(is_null($this->getData())) $ret = true;
        else
            $ret = false;

        if(!$ret)
            $this->processError('IsLengthInRange', [$this->getLabel(), $this->lowerBound, $this->upperBound, $this->inclusive]);

        return $ret;
    }
}