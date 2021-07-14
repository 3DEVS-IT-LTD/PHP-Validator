<?php
namespace ThreeDevs\validator\validators\classes;

use ThreeDevs\validator\Validation;

final class IsObject extends Validation
{
    protected function work(): bool
    {
        $ret = is_object($this->getData());

        if(!$ret)
            $this->processError('IsObject', [$this->getLabel()]);

        return $ret;
    }
}