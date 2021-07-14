<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class ArrayHasNotNullKey extends Validation
{
    private array $theArray = [];
    public function __construct($data = null, array $theArray)
    {
        parent::__construct($data);
        $this->theArray = $theArray;
    }
    protected function work(): bool
    {
        $ret = is_null($this->getData()) || is_bool($this->getData()) ? false : isset($this->theArray[$this->getData()]);

        if(!$ret)
            $this->processError('ArrayHasNotNullKey', [$this->getLabel()]);

        return $ret;
    }
}