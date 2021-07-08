<?php


namespace ThreeDevs\validator;


abstract class Validation
{
    private $data = null;
    private string $error_message = '';
    private bool $error = false;
    private string $label = '';
    private string $error_message_text = '';

    public function __construct($data = null)
    {
        $this->setData($data);
    }

    public abstract function validate(): bool;

    protected function processError(string $languageIndex, array $arguments = [])
    {
        if($this->getErrorMessageText())
            $template = $this->getErrorMessageText();
        else
            $template = ValidationLanguage::getText($languageIndex);

        $this->setErrorMessage(vsprintf($template, $arguments));
    }
    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->error_message;
    }

    /**
     * @param string $error_message
     * @return Validation
     */
    public function setErrorMessage(string $error_message): Validation
    {
        $this->error_message = $error_message;
        $this->setError(true);
        return $this;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->error;
    }

    /**
     * @param bool $error
     * @return Validation
     */
    public function setError(bool $error): Validation
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return Validation
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Validation
     */
    public function setLabel(string $label): Validation
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessageText(): string
    {
        return $this->error_message_text;
    }

    /**
     * @param string $error_message_text
     * @return Validation
     */
    public function setErrorMessageText(string $error_message_text): Validation
    {
        $this->error_message_text = $error_message_text;
        return $this;
    }

}