<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class ArrayHasKey extends Validation
{
    private array $theArray = [];
    public function __construct($data = null, array $theArray)
    {
        parent::__construct($data);
        $this->theArray = $theArray;
    }
    public function validate(): bool
    {
        $ret = array_key_exists($this->getData(), $this->theArray);

        if(!$ret)
            $this->processError('ArrayHasKey', [$this->getLabel()]);

        return $ret;
    }
}