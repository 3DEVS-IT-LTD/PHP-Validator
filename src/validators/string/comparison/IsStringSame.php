<?php


namespace ThreeDevs\validator\validators\string\comparison;

use ThreeDevs\validator\validators\string\IsString;

class IsStringSame extends \ThreeDevs\validator\Validation
{
    private string $compare_with = '';

    public function __construct($data = null, string $compare_with = '')
    {
        parent::__construct($data);
        $this->compare_with = $compare_with;
        $this->setErrorMessageText('%s is not same as %s');
    }

    protected function work(): bool
    {
        $ret = false;

        $ret = (new IsString($this->getData()))->validate() && $this->getData() == $this->compare_with;

        if(!$ret)
            $this->processError('IsStringSame', [$this->getLabel(), $this->compare_with]);

        return $ret;
    }
}