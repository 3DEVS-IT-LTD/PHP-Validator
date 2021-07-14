<?php


namespace ThreeDevs\validator\validators\string;


class IsStringLowerAlpha extends \ThreeDevs\validator\Validation
{
    private bool $allow_space = false;
    private bool $allow_dot = false;

    public function __construct($data = null, bool $allow_space = false, bool $allow_dot = false)
    {
        parent::__construct($data);
        $this->allow_dot = $allow_dot;
        $this->allow_space = $allow_space;
    }

    protected function work(): bool
    {
        $data = $this->getData();

        $additional = '';
        if($this->allow_space) $additional .= '\s';
        if($this->allow_dot) $additional .= '\.';

        $pattern = '/^[a-z'.$additional.']*$/';

        $ret = (new IsString($this->getData()))->validate() && preg_match($pattern, $this->getData());

        if(!$ret)
            $this->processError('IsStringLowerAlpha', [$this->getLabel()]);

        return $ret;
    }
}