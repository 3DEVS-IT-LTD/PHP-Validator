<?php
namespace ThreeDevs\validator\validators\number;

use ThreeDevs\validator\Validation;
use ThreeDevs\validator\ValidationLanguage;

final class IsLongitude extends Validation
{
    public function validate(): bool
    {
        $ret = false;
        $data = $this->getData();

        if(is_bool($data) || is_null($data))
            $ret = false;
        else
            $ret = ((new IsNumber($data))->validate() && $data >= -180 && $data <= 180);

        if(!$ret)
            $this->processError('IsLongitude', [$this->getLabel()]);

        return $ret;
    }
}