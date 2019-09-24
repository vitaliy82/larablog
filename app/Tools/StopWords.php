<?php

namespace App\Tools;

use App\Repositories\StopWordRepository;

class StopWords
{
    private $stop_words = [];

    function __construct(StopWordRepository $stopWordRepository)
    {
        $this->stop_words = $stopWordRepository->all(['word'])->pluck('word')->toArray();
    }

    /**
     * @param String $val
     * @return String
     */
    public function filter(String $val): String
    {
        foreach ($this->stop_words as $word) {
            if (false !== mb_strpos($val, $word)) {
                $val = str_replace($word, $this->generate_replacer($word), $val);
            }
        }
        return $val;
    }

    /**
     * @param String $val
     * @return String
     */
    private function generate_replacer(String $val): String
    {
        return mb_substr($val, 0, 1) . str_repeat("*", mb_strlen($val) - 2) . mb_substr($val, -1);
    }

}
