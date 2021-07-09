<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class ArrayHasNotNullKey extends Validation
{
    private array $theArray = [];
    public function __construct($data = null, array $theArray)
    {
        parent::__construct($data);
        $this->theArray = $theArray;
    }
    public function validate(): bool
    {
        $ret = isset($this->theArray[$this->getData()]);

        if(!$ret)
            $this->processError('ArrayHasNotNullKey', [$this->getLabel()]);

        return $ret;
    }
}