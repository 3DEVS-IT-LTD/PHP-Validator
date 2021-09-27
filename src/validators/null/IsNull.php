<?php


namespace ThreeDevs\validator\validators\null;

class IsNull extends \ThreeDevs\validator\Validation
{
    private bool $countNullString = false;
    public function __construct($data = null, bool $countNullString = false)
    {
        $this->countNullString = $countNullString;
        parent::__construct($data);
        $this->setErrorMessageText('%s is not null');
    }

    protected function work(): bool
    {
        $ret = false;

        if(is_null($this->getData()) || ($this->countNullString && is_string($this->getData()) && $this->getData() === 'null'))
            $ret = true;

        if(!$ret)
            $this->processError('IsNull', [$this->getLabel()]);

        return $ret;
    }
}