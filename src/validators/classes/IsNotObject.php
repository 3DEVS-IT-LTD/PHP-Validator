<?php
namespace ThreeDevs\validator\validators\classes;

use ThreeDevs\validator\Validation;

final class IsNotObject extends Validation
{
    public function validate(): bool
    {
        $ret = !is_object($this->getData());

        if(!$ret)
            $this->processError('IsNotObject', [$this->getLabel()]);

        return $ret;
    }
}