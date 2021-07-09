<?php


namespace ThreeDevs\validator\validators\string;


class IsStringAlpha extends \ThreeDevs\validator\Validation
{
   public function validate(): bool
    {
        $data = $this->getData();
        $ret = is_string($this->getData()) && preg_match('/^[a-z\s\.]*$/im');

        if(!$ret)
            $this->processError('IsStringAlpha', [$this->getLabel()]);

        return $ret;
    }
}