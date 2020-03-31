<?php
/**
 * Copyright MyTh
 * Website: https://4MyTh.com
 * Email: mythpe@gmail.com
 * Copyright © 2006-2020 MyTh All rights reserved.
 */

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