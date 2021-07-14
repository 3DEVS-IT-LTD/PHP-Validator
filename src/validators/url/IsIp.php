<?php
namespace ThreeDevs\validator\validators\url;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsIp extends Validation
{
    protected function work(): bool
    {
        $ret = is_string($this->getData()) && filter_var($this->getData(), FILTER_VALIDATE_IP);

        if(!$ret)
            $this->processError('IsIp', [$this->getLabel()]);

        return $ret;
    }
}