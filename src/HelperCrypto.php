<?php

namespace Ganjaaa;

class HelperCrypto {

    const HASH_ALGORITHM = 'sha256';
    const ITERATION_COUNT_MIN = 5000;
    const ITERATION_COUNT_MAX = 20000;
    const SALT_LENGTH_MAX = 32;
    CONST SALT_LENGTH_MIN = 16;
    const HASH_LENGTH = 250;
    const salt = 'nc87(7dfamn204xsj3234kdsfnm32458627324m6csfdsfsd87203ß23487dvc';

    /**
     * Verschlüsselt einen Text.
     *
     * @param string $cText
     * @param numeric $nAdjustment
     * @return string
     */
    static public function ceasar_cipher($cText, $nAdjustment) {
        if (empty($cText) || !is_string($cText))
            return false;
        for ($i = 0; $i < strlen($cText); $i++) {
            $cNewText .= chr(ord($cText{$i}) + $nAdjustment);
        }
        return $cNewText;
    }

    /**
     * Entschlüsselt einen Text.
     *
     * @param string $cText
     * @param numeric $nAdjustment
     * @return string
     */
    static public function ceasar_decipher($cText, $nAdjustment) {
        if (empty($cText) || !is_string($cText))
            return false;
        for ($i = 0; $i < strlen($cText); $i++) {
            $cNewText .= chr(ord($cText{$i}) - $nAdjustment);
        }
        return $cNewText;
    }

    /**
     * XOR Verschlüsselung mit Ver- und Entschlüsselungsfunktion
     *
     * @param type $InputString
     * @param type $KeyPhrase
     * @return type
     */
    static public function XOREncryption($InputString, $KeyPhrase) {
        $KeyPhraseLength = strlen($KeyPhrase);
        for ($i = 0; $i < strlen($InputString); $i++) {
            $rPos = $i % $KeyPhraseLength;
            $r = ord($InputString[$i]) ^ ord($KeyPhrase[$rPos]);
            $InputString[$i] = chr($r);
        }

        return $InputString;
    }

    /**
     * Hilfsfunktionen, die base64 benutzen um lesbaren Text zu erzeugen
     *
     * @param type $InputString
     * @param type $KeyPhrase
     * @return type
     */
    static public function XOREncrypt($InputString, $KeyPhrase) {
        $InputString = XOREncryption($InputString, $KeyPhrase);
        $InputString = self::base64_encode($InputString);
        return $InputString;
    }

    /**
     * Hilfsfunktionen, die base64 benutzen um lesbaren Text zu erzeugen
     *
     * @param type $InputString
     * @param type $KeyPhrase
     * @return type
     */
    static public function XORDecrypt($InputString, $KeyPhrase) {
        $InputString = base64_decode($InputString);
        $InputString = self::XOREncryption($InputString, $KeyPhrase);
        return $InputString;
    }

    /**
     * Password Hashing (geht auch sicherer)
     */
    public static function hashPassword($password, $iteration = 2, $algorythm = 'sha512') {
        for ($i = 0; $i < $iteration; $i++) {
            $password = hash($algorythm, $password . self::salt);
        }
        return $password;
    }

    /**
     * Erzeugt einen Salt
     * 
     * @return string
     */
    public static function getSalt() {
        $l = rand(self::SALT_LENGTH_MIN, self::SALT_LENGTH_MAX);
        $bytes = openssl_random_pseudo_bytes($l, true);
        return bin2hex($bytes);
    }

    /**
     * Erzeugt eine Zahl für eine Iteration
     * 
     * @return string
     */
    public static function getInteration() {
        return rand(self::ITERATION_COUNT_MIN, self::ITERATION_COUNT_MAX);
    }

    /**
     * Sicheres Hashen eines Passwortes
     * 
     * @param type $password
     * @return type
     */
    public static function safeCrypt($password) {
        $iteration = self::getInteration();
        $salt = self::getSalt();

        $hash = hash_pbkdf2(self::HASH_ALGORITHM, $password, $salt, $iteration, self::HASH_LENGTH, false);
        return array(
            'hash' => $hash,
            'iteration' => $iteration,
            'salt' => $salt
        );
    }

}
