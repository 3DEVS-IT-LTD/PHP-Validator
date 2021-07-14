<?php
namespace ThreeDevs\validator\validators\classes;

use ThreeDevs\validator\Validation;

final class IsNotObject extends Validation
{
    protected function work(): bool
    {
        $ret = !is_object($this->getData());

        if(!$ret)
            $this->processError('IsNotObject', [$this->getLabel()]);

        return $ret;
    }
}