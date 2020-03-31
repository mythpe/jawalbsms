<?php
/**
 * Copyright MyTh
 * Website: https://4MyTh.com
 * Email: mythpe@gmail.com
 * Copyright © 2006-2020 MyTh All rights reserved.
 */

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