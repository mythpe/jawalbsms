<?php
/**
 * Copyright MyTh
 * Website: https://4MyTh.com
 * Email: mythpe@gmail.com
 * Copyright © 2006-2020 MyTh All rights reserved.
 */

namespace Myth\Support\JawalBSms\Helpers;

/**
 * Class MStr
 * @package Myth\Support\JawalBSms\Helpers
 */
class MStr{

    /**
     * Begin a string with a single instance of a given value.
     * @param string $value
     * @param string $prefix
     * @return string
     */
    public static function start($value, $prefix){
        $quoted = preg_quote($prefix, '/');

        return $prefix.preg_replace('/^(?:'.$quoted.')+/u', '', $value);
    }

    /**
     * Determine if a given string starts with a given substring.
     * @param string $haystack
     * @param string|string[] $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles){
        foreach((array) $needles as $needle){
            if($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle){
                return true;
            }
        }

        return false;
    }

    /**
     * Parse mobile number to SAU with Country Code
     * @param $numbers
     * @return string
     */
    public static function saMobileNumber($numbers){
        /** @var array $result */
        $result = [];
        if(!is_array($numbers)) $numbers = explode(',', $numbers);
        $n = null;
        foreach($numbers as $k => $v){
            $n = &$numbers[$k];
            if(!is_string($n)){
                unset($numbers[$k]);
                unset($n);
                continue;
            }
            $n = ltrim($n, '+');
            static::startsWith($n, '00966') && ($n = substr($n, 5));
            static::startsWith($n, '00') && ($n = substr($n, 2));
            static::startsWith($n, '966') && ($n = substr($n, 3));
            $strlen = strlen($n);
            if(($strlen == 10 || $strlen == 9) && static::startsWith($n, ['05', '5'])){
                $n = static::start(ltrim($n, '0'), "966");
                !in_array($n, $result) && ($result[] = $n);
                unset($n);
            }
        }
        return implode(',', $result);
    }
}