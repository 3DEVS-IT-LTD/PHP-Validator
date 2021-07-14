<?php


namespace ThreeDevs\validator\validators\string;


class IsString extends \ThreeDevs\validator\Validation
{
    protected function work(): bool
    {
        $data = $this->getData();
        $ret = is_null($data) || is_bool($data) ? false : is_string($this->getData());

        if(!$ret)
            $this->processError('IsString', [$this->getLabel()]);

        return $ret;
    }
}