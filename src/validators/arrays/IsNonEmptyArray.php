<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class IsNonEmptyArray extends Validation
{
    public function validate(): bool
    {
        $ret = is_array($this->getData()) && $this->getData();

        if(!$ret)
            $this->processError('IsNonEmptyArray', [$this->getLabel()]);

        return $ret;
    }
}