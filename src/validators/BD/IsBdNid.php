<?php
namespace ThreeDevs\validator\validators\BD;

use ThreeDevs\validator\Validation;

final class IsBdNid extends Validation
{
    protected function work(): bool
    {
        $ret = false;
        $data = $this->getData();

        if(is_bool($data) || is_null($data))
            $ret = false;
        else
            $ret = preg_match('/^[0-9]{10}$|^[0-9]{17}$/', $data);

        if(!$ret)
            $this->processError('IsBdNid', [$this->getLabel()]);

        return $ret;
    }
}