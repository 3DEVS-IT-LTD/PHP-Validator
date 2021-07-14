<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class IsArray extends Validation
{
    protected function work(): bool
    {
        $ret = is_array($this->getData());

        if(!$ret)
            $this->processError('IsArray', [$this->getLabel()]);

        return $ret;
    }
}