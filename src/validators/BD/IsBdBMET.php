<?php
namespace ThreeDevs\validator\validators\BD;

use ThreeDevs\validator\Validation;

final class IsBdBMET extends Validation
{
    protected function work(): bool
    {
        $ret = false;
        $data = $this->getData();
        $pattern = '/^\d{11}$/';

        if(is_bool($data) || is_null($data))
            $ret = false;
        else
            $ret = preg_match($pattern, $data);

        if(!$ret)
            $this->processError('IsBdBMET', [$this->getLabel()]);

        return $ret;
    }
}