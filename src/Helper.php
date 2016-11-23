<?php

namespace Ganjaaa;

use \DateTime;

class Helper {

    /** See HelperTime.php * */
    public static function minToTime($min, $vorzeichen = false, $blankZero = false) {
        return HelperTime::minToTime($min, $vorzeichen, $blankZero);
    }

    public static function minToDaytime($min, $soll = 8) {
        return HelperTime::minToDaytime($min, $soll);
    }

    public static function timeToMin($time) {
        return HelperTime::timeToMin($time);
    }

    public static function isHoliday(DateTime $date) {
        return HelperTime::isHoliday($date);
    }

    public static function dateStringToDateTime($str) {
        return HelperTime::dateStringToDateTime($str);
    }

    static public function getAge($mDate) {
        return HelperTime::getAge($mDate);
    }

    /** See HelperMath.php * */
    static public function sum() {
        $args = func_get_args();
        return call_user_func_array("HelperMath::sum", $args);
    }

    public static function baseround($val, $round) {
        return HelperMath::baseround($val, $round);
    }

    public static function halfround($val) {
        return HelperMath::halfround($val);
    }

    /* See HelperFilter.php ******************************************************************************************************* */

    public static function filterPost($variable_name, $filter = FILTER_SANITIZE_STRING) {
        return HelperFilter::filterPost($variable_name, $filter);
    }

    public static function filterGet($variable_name, $filter = FILTER_SANITIZE_STRING) {
        return HelperFilter::filterGet($variable_name, $filter);
    }

    public static function filterPostArray($variable_name, $filter = FILTER_SANITIZE_STRING) {
        return HelperFilter::filterPostArray($variable_name, $filter);
    }

    public static function filterGetArray($variable_name, $filter = FILTER_SANITIZE_STRING) {
        return HelperFilter::filterGetArray($variable_name, $filter);
    }

    public static function extraktInt($str) {
        return HelperFilter::extraktInt($str);
    }

    /* See HelperCrypto.php ******************************************************************************************************* */

    static public function XORDecrypt($InputString, $KeyPhrase) {
        return HelperCrypto::XORDecrypt($InputString, $KeyPhrase);
    }

    static public function XOREncrypt($InputString, $KeyPhrase) {
        return HelperCrypto::XOREncrypt($InputString, $KeyPhrase);
    }

    static public function XOREncryption($InputString, $KeyPhrase) {
        return HelperCrypto::XOREncryption($InputString, $KeyPhrase);
    }

    static public function ceasar_decipher($cText, $nAdjustment) {
        return HelperCrypto::ceasar_decipher($cText, $nAdjustment);
    }

    static public function ceasar_cipher($cText, $nAdjustment) {
        return HelperCrypto::ceasar_cipher($cText, $nAdjustment);
    }

    public static function hashPassword($password, $iteration = 2, $algorythm = 'sha512') {
        return HelperCrypto::hashPassword($password, $iteration, $algorythm);
    }

    public static function getSalt() {
        return HelperCrypto::getSalt();
    }

    public static function getInteration() {
        return HelperCrypto::getInteration();
    }

    public static function safeCrypt($password) {
        return HelperCrypto::safeCrypt($password);
    }

}
