<?php
namespace ThreeDevs\validator\validators\BD;

use ThreeDevs\validator\Validation;

final class IsBdPassport extends Validation
{
    protected function work(): bool
    {
        $ret = false;
        $data = $this->getData();
        $pattern = '/^[a-zA-Z]{1}[a-zA-Z\d]{1}\d{7}$/';

        if(is_bool($data) || is_null($data))
            $ret = false;
        else
            $ret = preg_match($pattern, $data);

        if(!$ret)
            $this->processError('IsBdPassport', [$this->getLabel()]);

        return $ret;
    }
}