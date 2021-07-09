<?php
namespace ThreeDevs\validator\validators\classes;

use ThreeDevs\validator\Validation;

final class IsInstanceOf extends Validation
{
    private $the_class = '';
    public function __construct(?object $data = null, string $the_class)
    {
        parent::__construct($data);
        $this->the_class = $the_class;
    }

    public function validate(): bool
    {
        $ret = $this->getData() instanceof $this->the_class;

        if(!$ret)
            $this->processError('IsInstanceOf', [$this->getLabel()]);

        return $ret;
    }
}