<?php

namespace Ganjaaa;

class HelperTime {

    /**
     * Wandelt Minuten in ein Zeitformat um HH:MM
     *
     * @param integer $min Minuten zum umwandeln
     * @param boolean $vorzeichen Soll Vorzeichen angezeigt werden
     * @param boolean $blankZero Anstelle von "00:00" wird ein leerer String zurückgegeben
     * @return String
     */
    public static function minToTime($min, $vorzeichen = false, $blankZero = false) {
        $time = (($min < 0 && $vorzeichen) ? '- ' : (($vorzeichen) ? '+ ' : '')) . floor(abs($min) / 60) . ':' . sprintf('%02d', (abs($min) % 60)); #
        return $blankZero && $time == "00:00" ? '' : $time;
    }

    /**
     * Wandelt Minuten in ein Zeitformat um D Tag(e) HH Stunden MM Minuten.
     * Konzipiert um 8h (ein Arbeitstag) anzuzeigen
     *
     * @param integer $min Minuten zum umwandeln
     * @param integer $soll Stundenanzahl des Tages
     * @return String
     */
    public static function minToDaytime($min, $soll = 8) {
        $minuten = abs($min) % 60;
        $tage = floor(abs($min) / $soll / 60);
        $stunden = floor(abs($min) / 60) % $soll;
        return ($min < 0 ? '-' : '') . $tage . ' Tag(e) ' . $stunden . ' Stunden ' . $minuten . ' Minuten';
    }

    /**
     * Wandelt Zeit im Format HH:MM in Minuten um ansonsten wir die Zeit als Minuten behandelt
     *
     * @param String $time Zeit im Format HH:mm oder mm
     * @return Integer
     */
    public static function timeToMin($time) {
        $a = explode(':', $time);
        if (count($a) == 2) {
            return (($a[0] * 60) + $a[1]);
        } else {
            return ($time);
        }
    }

    /**
     * Prüfung auf Feiertage
     *
     * @param DateTime $date zu prüfendes Datum
     * @return FALSE Normaler Wochentag
     * @return TRUE Wochenende/Feiertag
     * @return NULL Halber Arbeitstag
     */
    public static function isHoliday(DateTime $date) {
        $intday = $date->format('md');

        $easter = new DateTime(date('Y-m-d', easter_date($date->format('Y'))));
        $easter->sub(new DateInterval('P2D'));
        $k = $easter->format('md');
        $easter->add(new DateInterval('P3D'));
        $om = $easter->format('md');
        $easter->add(new DateInterval('P38D'));
        $h = $easter->format('md');
        $easter->add(new DateInterval('P11D'));
        $pm = $easter->format('md');

        $tage = array(
            '0101' => true, // Neujahr
            $k => true, // Karfreitag O-2
            $om => true, // Ostermontag O+1
            '0501' => true, // 1 Mai
            $h => true, // Himmelfahrt O+39
            $pm => true, // Pfingsmontag O+50
            '1003' => true, // Tag der Einheit
            '1225' => true, // Weinachten 1
            '1226' => true, // weinachten 2
        );
        if ($intday == '1224' || $intday == '1231') // Halbe Tage für Heiligabend und Sylvester (offizell kein Feiertag!)
            return NULL;
        return ((isset($tage[$intday]) && $tage[$intday]) || $date->format('w') == '0' || $date->format('w') == '6') ? true : false;
    }

    /**
     * Wandelt einen String gängiger Datumsformate in DateTime um.
     * Zb für 7 Januar 2016
     * 2016-01-07
     * 16-01-07
     * 2016-1-7
     * 16-1-7
     * 07.01.2016
     * 7.1.16
     * Ansonsten NULL
     * @param string $str
     * @return DateTime
     * @return NULL wenn das Format unbekannt ist
     */
    public static function dateStringToDateTime($str) {
        if (is_object($str) && get_class($str) == "DateTime")
            return $str;

        $str = trim($str);
        $english = substr_count($str, '-');
        $german = substr_count($str, '.');

        $reg_en = array(
            'Y-m-d H:i:s' => '/^\d{4}\-\d{2}\-\d{2} \d{2}\:\d{2}\:\d{2}$/',
            'Y-m-d' => '/^\d{4}\-\d{2}\-\d{2}$/',
            'y-m-d' => '/^\d{2}\-\d{2}\-\d{2}$/',
            'Y-n-j' => '/^\d{4}\-\d{1,2}\-\d{1,2}$/',
            'y-n-j' => '/^\d{2}\-\d{1,2}\-\d{1,2}$/'
        );
        $reg_de = array(
            'd.m.Y' => '/^\d{2}\.\d{2}\.\d{4}$/',
            'd.m.y' => '/^\d{1,2}\.\d{1,2}\.\d{2}$/',
            'j.n.Y' => '/^\d{1,2}\.\d{1,2}\.\d{4}$/',
            'j.n.y' => '/^\d{1,2}\.\d{1,2}\.\d{2}$/'
        );
        $reg_alg = array(
            'Ymd' => '/^\d{8}$/'
        );

        if ($english == 2) {
            foreach ($reg_en as $k => $v) {
                if (preg_match($v, $str)) {
                    return DateTime::createFromFormat($k, $str);
                }
            }
        }
        if ($german == 2) {
            foreach ($reg_de as $k => $v) {
                if (preg_match($v, $str)) {
                    return DateTime::createFromFormat($k, $str);
                }
            }
        }
        foreach ($reg_alg as $k => $v) {
            if (preg_match($v, $str)) {
                return DateTime::createFromFormat($k, $str);
            }
        }
        return NULL;
    }

    /**
     * Liefert das aktuelle Alter zurück.
     *
     * @param mixed $mDate
     * @return int
     */
    static public function getAge($mDate) {
        if (empty($mDate))
            return false;
        $aValue = explode('-', $mDate);
        $cAge = date('Y') - $aValue[0];
        $cDiff = mktime(0, 0, 0, $aValue[1], $aValue[2], date('Y'));
        if ($cDiff > time())
            $cAge--;
        return $cAge;
    }

}
