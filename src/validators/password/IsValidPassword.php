<?php


namespace ThreeDevs\validator\validators\password;

use ThreeDevs\validator\validators\string\IsString;

class IsValidPassword extends \ThreeDevs\validator\Validation
{
    private int $minLength = 8;
    private int $maxLength = 24;
    private bool $atLeastOneNumber;
    private bool $atLeastOneLowerCaseLetter;
    private bool $atLeastOneUpperCaseLetter;
    private bool $atLeastOneSpecialCharacter;
    private bool $allowWhitespace;

    public function __construct($data = null, int $minLength = 8, int $maxLength = 24, bool $atLeastOneNumber = true, bool $atLeastOneLowerCaseLetter = true, bool $atLeastOneUpperCaseLetter = true, bool $atLeastOneSpecialCharacter = true, bool $allowWhitespace = true)
    {
        parent::__construct($data);
        $this->minLength = $minLength > 0 ? $minLength : $this->minLength;
        $this->maxLength = $maxLength > $this->minLength ? $maxLength : $this->maxLength;
        $this->atLeastOneNumber = $atLeastOneNumber;
        $this->atLeastOneLowerCaseLetter = $atLeastOneLowerCaseLetter;
        $this->atLeastOneUpperCaseLetter = $atLeastOneUpperCaseLetter;
        $this->atLeastOneSpecialCharacter = $atLeastOneSpecialCharacter;
        $this->allowWhitespace = $allowWhitespace;

        $message = '%s is not a valid password. A valid password should contain ';

        if($this->atLeastOneNumber) $message .= 'one digit, ';
        if($this->atLeastOneLowerCaseLetter) $message .= 'one lowercase letter, ';
        if($this->atLeastOneUpperCaseLetter) $message .= 'one uppercase letter, ';
        if($this->atLeastOneSpecialCharacter) $message .= 'one special character, ';

        $message .= " and must be between ".$this->minLength.' to '.$this->maxLength.' characters in length.';

        if($this->allowWhitespace) $message .= " It can also contain whitespace.";

        $this->setErrorMessageText($message);
    }

    protected function work(): bool
    {
        $ret = false;

        $pattern = '/^'.($this->atLeastOneLowerCaseLetter ? '(?=.*[a-z])' : '').($this->atLeastOneUpperCaseLetter ? '(?=.*[A-Z])' : '').($this->atLeastOneNumber ? '(?=.*\d)' : '').($this->atLeastOneSpecialCharacter ? '(?=.*[@$!%*?&])' : '').'[A-Za-z'.($this->allowWhitespace ? '\s' : '').'\d@$!%*?&]{'.$this->minLength.','.$this->maxLength.'}$/';

        $ret = (new IsString($this->getData()))->validate() && preg_match($pattern, $this->getData());

        if(!$ret)
            $this->processError('IsValidPassword', [$this->getLabel()]);

        return $ret;
    }
}