<?php


namespace ThreeDevs\validator\validators\string\comparison;


class IsLengthNotEqual extends \ThreeDevs\validator\Validation
{
    private int $length = 0;

    public function __construct($data = null, int $length)
    {
        parent::__construct($data);
        $this->length = $length;
    }

    protected function work(): bool
    {
        $ret = is_string($this->getData()) && mb_strlen($this->getData()) != $this->length;

        if(!$ret)
            $this->processError('IsLengthNotEqual', [$this->getLabel(), $this->length]);

        return $ret;
    }
}