<?php
namespace ThreeDevs\validator\validators\mobile;

use ThreeDevs\validator\Validation;

final class IsBdMobile extends Validation
{
    protected function work(): bool
    {
        $ret = false;
        $data = $this->getData();

        if(is_bool($data) || is_null($data))
            $ret = false;
        else
            $ret = preg_match('/^(017|018|019|015|016|013|014)[0-9]{8}$/', $data);

        if(!$ret)
            $this->processError('IsBdMobile', [$this->getLabel()]);

        return $ret;
    }
}