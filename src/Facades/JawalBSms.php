<?php

namespace MyTh\Support\JawalBSms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class JawalBSms
 * @package MyTh\Support\JawalBSms\Facades
 */
class JawalBSms extends Facade{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(){
        return 'myth.support.jawalbsms';
    }
}