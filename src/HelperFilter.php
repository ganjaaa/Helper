<?php

namespace Ganjaaa;

class HelperFilter {

    /**
     * Shortcut
     * 
     * @param type $variable_name
     * @param type $filter
     * @return type
     */
    public static function filterPost($variable_name, $filter = FILTER_SANITIZE_STRING) {
        return filter_input(INPUT_POST, $variable_name, $filter);
    }

    /**
     * Shortcut
     * 
     * @param type $variable_name
     * @param type $filter
     * @return type
     */
    public static function filterGet($variable_name, $filter = FILTER_SANITIZE_STRING) {
        return filter_input(INPUT_GET, $variable_name, $filter);
    }

    /**
     * Shortcut
     * 
     * @param type $variable_name
     * @param type $filter
     * @return type
     */
    public static function filterPostArray($variable_name, $filter = FILTER_SANITIZE_STRING) {
        return filter_input(INPUT_POST, $variable_name, $filter, FILTER_REQUIRE_ARRAY);
    }

    /**
     * Shortcut
     * 
     * @param type $variable_name
     * @param type $filter
     * @return type
     */
    public static function filterGetArray($variable_name, $filter = FILTER_SANITIZE_STRING) {
        return filter_input(INPUT_GET, $variable_name, $filter, FILTER_REQUIRE_ARRAY);
    }

    /**
     * 
     * 
     * @param type $str
     * @return array
     */
    public static function extraktInt($str) {
        $matches = array();
        $zahl = 0;
        if (preg_match("/[0-9]+/", $str, $matches))
            $zahl = $matches[0];
        return $zahl;
    }

}
