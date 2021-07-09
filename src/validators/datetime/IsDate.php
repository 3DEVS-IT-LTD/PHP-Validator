<?php


namespace ThreeDevs\validator\validators\datetime;


use DateTime;

class IsDate extends \ThreeDevs\validator\Validation
{
    private string $format = 'Y-m-d';
    public function __construct($data = null, $format = 'Y-m-d')
    {
        parent::__construct($data);
        $this->format = $format;
    }

    public function validate(): bool
    {
        $ret = false;
        $data = $this->getData();

        $dateObj = DateTime::createFromFormat($this->format, $data);
        $ret = $dateObj && $dateObj->format($this->format) == $data;

        if(!$ret) $this->processError('IsDate', [$this->getLabel(), $this->format]);

        return $ret;
    }
}