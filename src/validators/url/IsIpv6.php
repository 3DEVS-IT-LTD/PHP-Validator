<?php
namespace ThreeDevs\validator\validators\url;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsIpv6 extends Validation
{
    public function validate(): bool
    {
        $ret = is_string($this->getData()) && filter_var($this->getData(), FILTER_VALIDATE_IP | FILTER_FLAG_IPV6);

        if(!$ret)
            $this->processError('IsIpv6', [$this->getLabel()]);

        return $ret;
    }
}