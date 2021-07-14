<?php
namespace ThreeDevs\validator\validators\arrays;

use ThreeDevs\validator\Validation;

final class IsInArray extends Validation
{
    private array $theArray = [];
    private bool $is_strict = false;

    //TODO: is_strict should be optional
    public function __construct($data = null, array $theArray, bool $is_strict)
    {
        parent::__construct($data);
        $this->theArray = $theArray;
        $this->is_strict = $is_strict;
    }

    public function validate(): bool
    {
        $ret = in_array($this->getData(), $this->theArray, $this->is_strict) !== false;

        if(!$ret)
            $this->processError('IsInArray', [$this->getLabel()]);

        return $ret;
    }
}