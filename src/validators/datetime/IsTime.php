<?php


namespace ThreeDevs\validator\validators\datetime;


use DateTime;

class IsTime extends \ThreeDevs\validator\Validation
{
    private string $format = 'H:i:s';
    public function __construct($data = null, $format = 'H:i:s')
    {
        parent::__construct($data);
        $this->format = $format;
    }

    protected function work(): bool
    {
        $ret = false;
        $data = $this->getData();

        $dateObj = DateTime::createFromFormat($this->format, $data);
        $ret = $dateObj && $dateObj->format($this->format) == $data;

        if(!$ret) $this->processError('IsTime', [$this->getLabel(), $this->format]);

        return $ret;
    }
}