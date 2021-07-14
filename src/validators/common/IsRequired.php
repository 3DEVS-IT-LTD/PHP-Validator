<?php

namespace ThreeDevs\validator\validators\common;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsRequired extends Validation
{
    protected function work(): bool
    {
        $ret = !(is_null($this->getData()) || (is_string($this->getData()) && !mb_strlen($this->getData())));

        if(!$ret)
            $this->processError('IsRequired', [$this->getLabel()]);

        return $ret;
    }
}