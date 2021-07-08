<?php

namespace ThreeDevs\validator\validators\common;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsRequired extends Validation
{
    public function validate(): bool
    {
        $ret = false;
        $data = $this->getData();

        if(is_null($data) || (is_string($data) && !mb_strlen($data))) $ret = false;
        else $ret = true;

        if(!$ret)
            $this->processError('IsRequired', [$this->getLabel()]);

        return $ret;
    }
}