<?php


namespace ThreeDevs\validator;


class Validator
{
    private array $sourceData = [];
    private array $fieldAliases = [];
    /** @var Validation[] $validations */
    private array $validations = [];
    private array $per_validation_fields = [];
    private string $current_language = '';
    private array $lang = [];
    private array $error_messages = [];
    private bool $error = false;

    /**
     * validator constructor.
     * @param array $data
     * @param array $aliases
     * @param string $language
     */
    public function __construct(array $data, array $aliases = [], string $language = 'en')
    {
        $this->sourceData = $data;
        $this->fieldAliases = $aliases ? $aliases : [];
        $this->errors = [];
        $this->validations = [];
        $this->current_language = $language;
        ValidationLanguage::setLang($language);
    }
    public function add_validation(Validation $v, array $fields)
    {
        $this->per_validation_fields[] = $fields;
        $this->validations[] = $v;
    }
    public function validate()
    {
        $this->resetErrors();

        foreach ($this->validations as $i=>$v){
            foreach($this->per_validation_fields[$i] as $field){
                if(array_key_exists($field, $this->sourceData)){
                    if(isset($this->fieldAliases[$field]))
                        $v->setLabel($this->fieldAliases[$field]);
                    else
                        $v->setLabel($field);

                    $v->setData($this->sourceData[$field]);
                    $v->validate();
                    if($v->isError()) $this->setErrorMessages($v->getErrorMessage());
                }
            }
        }

        return !$this->isError();
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
     * @return Validator
     */
    public function setError(bool $error): Validator
    {
        $this->error = $error;
        return $this;
    }

    private function resetErrors()
    {
        $this->error_messages = [];
        $this->setError(false);
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return $this->error_messages;
    }

    /**
     * @param string $error
     * @return Validator
     */
    public function setErrorMessages(string $error): Validator
    {
        $this->error_messages[] = $error;
        $this->setError(true);
        return $this;
    }

}