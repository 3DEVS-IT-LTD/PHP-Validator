<?php
namespace ThreeDevs\validator\validators\number;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsInteger extends Validation
{
    public function validate(): bool
    {
        $ret = false;
        $data = $this->getData();

        if(is_bool($data) || is_null($data))
            $ret = false;
        else
            $ret = preg_match('/^([0-9]|-[1-9]|-?[1-9][0-9]*)$/', $data);

        if(!$ret)
            $this->processError('IsInteger', [$this->getLabel()]);

        return $ret;
    }
}