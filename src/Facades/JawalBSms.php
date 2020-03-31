<?php
namespace Myth\Support\JawalBSms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class JawalBSms
 * @package Myth\Support\JawalBSms\Facades
 */
class JawalBSms extends Facade{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(){
        return 'myth.support.jawalbsms';
    }
}