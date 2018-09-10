<?php

class Feb {
    /*
      Funkcja do usuwania polskich znakow z tekstu o dowolnym kodowaniu
      Autor: Marius Maximus
      Inspiracja:  http://4programmers.net/PHP/FAQ/Jak_zmieni%C4%87_kodowanie_tekstu_nie_maj%C4%85c_dost%C4%99pu_do_funkcji_iconv_%5C

      Sposob uzycia:
      $zmienna = strip_pl("jakiś tekst z PL-znakami np. ŻÓŁĆ");

     */

    public static function normalize($text) {
        $tabela = Array(
            //WIN
            "xb9" => "a", "xa5" => "A", "xe6" => "c", "xc6" => "C",
            "xea" => "e", "xca" => "E", "xb3" => "l", "xa3" => "L",
            "xf3" => "o", "xd3" => "O", "x9c" => "s", "x8c" => "S",
            "x9f" => "z", "xaf" => "Z", "xbf" => "z", "xac" => "Z",
            "xf1" => "n", "xd1" => "N",
            //UTF
            "xc4x85" => "a", "xc4x84" => "A", "xc4x87" => "c", "xc4x86" => "C",
            "xc4x99" => "e", "xc4x98" => "E", "xc5x82" => "l", "xc5x81" => "L",
            "xc3xb3" => "o", "xc3x93" => "O", "xc5x9b" => "s", "xc5x9a" => "S",
            "xc5xbc" => "z", "xc5xbb" => "Z", "xc5xba" => "z", "xc5xb9" => "Z",
            "xc5x84" => "n", "xc5x83" => "N",
            //ISO
            "xb1" => "a", "xa1" => "A", "xe6" => "c", "xc6" => "C",
            "xea" => "e", "xca" => "E", "xb3" => "l", "xa3" => "L",
            "xf3" => "o", "xd3" => "O", "xb6" => "s", "xa6" => "S",
            "xbc" => "z", "xac" => "Z", "xbf" => "z", "xaf" => "Z",
            "xf1" => "n", "xd1" => "N");

        $text = strtr($text, $tabela);
        $text = str_replace("'", '', iconv('UTF-8', 'US-ASCII//TRANSLIT', str_replace("'", '&' . '#39;', $text)));
        $text = preg_replace('/[^A-Z^a-z^0-9]+/', '_', preg_replace('/([a-zd])([A-Z])/', '1_2', preg_replace('/([A-Z]+)([A-Z][a-z])/', '1_2', $text)));
        return strtolower($text);
    }

    public static function getProjectName($customValue = array()) {


        if (isSet($customValue['@name'])) {
            if ($customValue['@name'] == 'Projekt') {
                return trim($customValue['@value']);
            }
        } else if (isSet($customValue[0])) {
            foreach ($customValue as $value) {
                if ($value['@name'] == 'Projekt') {
                    return trim($value['@value']);
                }
            }
        }
        return null;
        throw new Exception('Project not found in specification');
    }

    public static function getUniqDbName($prefix, $dbList) {
        $try = rand(1, 999);
        if (!in_array($ret = $prefix . $try, $dbList)) {
            return $try;
        } else {
            self::getUniqDbName($prefix, $dbList);
        }
    }

}

?>
