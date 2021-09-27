<?php


namespace ThreeDevs\validator\validators\arrays;


use ThreeDevs\validator\validators\null\IsNull;

class IsSetNotNull extends \ThreeDevs\validator\Validation
{

    private array $haystack;
    private bool $countNullString = false;
    public function __construct($data = null, array $haystack, bool $countNullString = false)
    {
        parent::__construct($data);
        $this->haystack = $haystack;
        $this->countNullString = $countNullString;

        $this->setErrorMessageText('%s is not null');
    }

    protected function work(): bool
    {
        $ret = false;

        $isset = isset($this->haystack[$this->getData()]) ? true : false;

        if($isset){
            $ret = true;
            if($ret && is_string($this->haystack[$this->getData()]) && !strlen($this->haystack[$this->getData()]))
                $ret = false;
            if($ret && (new IsNull($this->haystack[$this->getData()], $this->countNullString))->validate())
                $ret = false;
        }


        if(!$ret)
            $this->processError('IsSetNotNull', [$this->getLabel()]);

        return $ret;
    }
}