<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class IsNotInArray extends Validation
{
    private array $theArray = [];
    private bool $is_strict = false;

    public function __construct($data = null, array $theArray, bool $is_strict)
    {
        parent::__construct($data);
        $this->theArray = $theArray;
        $this->is_strict = $is_strict;
    }

    protected function work(): bool
    {
        $ret = in_array($this->getData(), $this->theArray, $this->is_strict) === false;

        if(!$ret)
            $this->processError('IsNotInArray', [$this->getLabel()]);

        return $ret;
    }
}