<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class IsNotArray extends Validation
{
    protected function work(): bool
    {
        $ret = !is_array($this->getData());

        if(!$ret)
            $this->processError('IsNotArray', [$this->getLabel()]);

        return $ret;
    }
}