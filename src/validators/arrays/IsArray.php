<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class IsArray extends Validation
{
    public function validate(): bool
    {
        $ret = is_array($this->getData());

        if(!$ret)
            $this->processError('IsArray', [$this->getLabel()]);

        return $ret;
    }
}