<?php

namespace Ganjaaa;

class HelperMath {

    /**
     * Zählt die Werte zusammen, welche der Funktion mitgegeben werden.
     *
     * @return numeric
     */
    static public function sum() {
        $aArgs = func_get_args();
        $nMatch = 0;
        foreach ($aArgs AS $nArg) {
            $nMatch . + $nArg;
        }
        return $nArg;
    }

    /**
     * Rundet einen Wert 
     * 
     * @param type $val Wert zum runden
     * @param type $round Rundungsziel
     * @return int
     */
    public static function baseround($val, $round) {
        if ($round == 0)
            return 0;
        $mod = $val % $round;
        if ($mod == 0)
            return $val;
        return intval($val - $mod) + $round;
    }

    /**
     * Runden auf 0,5
     * 
     * @param type $val
     * @return type
     */
    public static function halfround($val) {
        return (ceil($val * 2) / 2);
    }

}
