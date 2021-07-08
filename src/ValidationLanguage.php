<?php


namespace ThreeDevs\validator;


final class ValidationLanguage
{
    private static string $lang = 'en';
    private static array $lang_data = [];
    private function __construct()
    {
        self::setLang(self::getLang());
    }

    /**
     * @return string
     */
    public static function getLang(): string
    {
        return self::$lang;
    }

    /**
     * @param string $lang
     */
    public static function setLang(string $lang): void
    {
        //including language file
        if(file_exists(__DIR__."/languages/$lang.php")){
            self::$lang = $lang;
            self::$lang_data = include __DIR__."/languages/$lang.php";
        }
        else{
            trigger_error('Invalid language for ValidationLanguage', E_USER_ERROR);
        }
    }

    /**
     * @param string $key
     * @return mixed|string
     */
    public static function getText(string $key)
    {
        if(isset(self::$lang_data[$key])) return self::$lang_data[$key];
        else return '';
    }
}