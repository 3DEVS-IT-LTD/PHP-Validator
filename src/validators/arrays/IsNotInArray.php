<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class IsNotInArray extends Validation
{
    private array $theArray = [];
    public function __construct($data = null, array $theArray)
    {
        parent::__construct($data);
        $this->theArray = $theArray;
    }

    public function validate(): bool
    {
        $ret = in_array($this->getData(), $this->theArray) === false;

        if(!$ret)
            $this->processError('IsNotInArray', [$this->getLabel()]);

        return $ret;
    }
}