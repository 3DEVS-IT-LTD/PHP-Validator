<?php


namespace ThreeDevs\validator\validators\datetime;


use DateTime;

class IsDateTime extends \ThreeDevs\validator\Validation
{
    private string $format = 'Y-m-d H:i:s';
    public function __construct($data = null, $format = 'Y-m-d H:i:s')
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

        if(!$ret) $this->processError('IsDateTime', [$this->getLabel(), $this->format]);

        return $ret;
    }
}