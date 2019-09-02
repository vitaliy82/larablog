<?php

namespace App\Rules;

class StopWords
{
   private const stop_words = [
       'бублик',
       'ревербератор',
       'кастет',
       'хорь',
       'алкоголь',
       'превысокомногорассмотрительствующий',
       'гражданин',
       'паста'
   ];

    /**
     * @param String $val
     * @return String
     */
    public static function filter(String $val) : String
    {
        foreach (self::stop_words as $word){
            if(false !== mb_strpos($val, $word)){
                $val = str_replace($word, self::generate_replacer($word), $val);
            }
        }

        return $val;
    }

    /**
     * @param String $val
     * @return String
     */
    private static function generate_replacer(String $val) : String
    {

       return mb_substr($val, 0, 1) . str_repeat("*", mb_strlen($val)-2) . mb_substr($val, -1);
    }

}
