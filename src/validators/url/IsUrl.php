<?php
namespace ThreeDevs\validator\validators\url;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsUrl extends Validation
{
    public function validate(): bool
    {
        $ret = is_string($this->getData()) && filter_var($this->getData(), FILTER_VALIDATE_URL);

        if(!$ret)
            $this->processError('IsUrl', [$this->getLabel()]);

        return $ret;
    }
}