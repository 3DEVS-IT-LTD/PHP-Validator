<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class IsEmptyArray extends Validation
{
    public function validate(): bool
    {
        $ret = is_array($this->getData()) && !$this->getData();

        if(!$ret)
            $this->processError('IsEmptyArray', [$this->getLabel()]);

        return $ret;
    }
}