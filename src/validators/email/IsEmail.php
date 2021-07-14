<?php
namespace ThreeDevs\validator\validators\email;

use ThreeDevs\validator\Validation;

final class IsEmail extends Validation
{
    protected function work(): bool
    {
        $ret = false;
        $data = $this->getData();

        if(is_bool($data) || is_null($data))
            $ret = false;
        else
            $ret = filter_var($data, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $data);

        if(!$ret)
            $this->processError('IsEmail', [$this->getLabel()]);

        return $ret;
    }
}