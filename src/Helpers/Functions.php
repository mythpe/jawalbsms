<?php
/**
 * Copyright MyTh
 * Website: https://4MyTh.com
 * Email: mythpe@gmail.com
 * Copyright © 2006-2020 MyTh All rights reserved.
 */

use Myth\Support\JawalBSms\Facades\JawalBSms;

if(!function_exists('send_sms')){

    /**
     * send new sms message to specific mobile numbers from jawalbsms
     * @param string $message
     * @param string|string[] $numbers
     * @return bool|string|null
     */
    function send_sms($message, $numbers){
        return JawalBSms::sendSms($message, $numbers);
    }
}