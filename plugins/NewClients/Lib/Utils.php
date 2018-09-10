<?php

class Utils {

    /**
     * Multibyte str_split - uwzględniający znaki dwubajtowe
     */
    static function mb_str_split($str) {
        return preg_split('~~u', $str, null, PREG_SPLIT_NO_EMPTY);;
    }

    /**
     * Usuwa polskie znaki diaktrytyczne z łąńcucha
     */
    static function stripAccents($str){
        return str_replace(Utils::mb_str_split('ąćęłńóśźżĄĆĘŁŃÓŚŹŻ'), Utils::mb_str_split('acelnoszzACELNOSSZZ'), $str);
    }

    /**
     * Zamienia nazwę katalogu na FileSystem-friendly
     */
    static public function transliterate($str) {
        $str = strtr(Utils::stripAccents($str), ' :', '__');
        return $str;
    }

}