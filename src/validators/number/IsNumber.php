<?php
namespace ThreeDevs\validator\validators\number;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsNumber extends Validation
{
    protected function work(): bool
    {
        $ret = false;
        $data = $this->getData();

        if(is_bool($data) || is_null($data))
            $ret = false;
        else
            $ret = preg_match('/^-?(\d|[1-9]+\d*|\.\d+|0\.\d+|[1-9]+\d*\.\d+)$/', $data);

        if(!$ret)
            $this->processError('IsNumber', [$this->getLabel()]);

        return $ret;
    }
}