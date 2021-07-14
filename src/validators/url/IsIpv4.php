<?php
namespace ThreeDevs\validator\validators\url;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsIpv4 extends Validation
{
    protected function work(): bool
    {
        $ret = is_string($this->getData()) && filter_var($this->getData(), FILTER_VALIDATE_IP | FILTER_FLAG_IPV4);

        if(!$ret)
            $this->processError('IsIpv4', [$this->getLabel()]);

        return $ret;
    }
}