<?php
/**
 * Copyright MyTh
 * Website: https://4MyTh.com
 * Email: mythpe@gmail.com
 * Copyright © 2006-2020 MyTh All rights reserved.
 */

namespace Myth\Support\JawalBSms;

use GuzzleHttp\Client;
use Myth\Support\JawalBSms\Helpers\MStr;

/**
 * Class SmsWrapper
 * @package Myth\Support\JawalBSms
 */
class SmsWrapper{

    /** @var string jawalbsms api url */
    const JAWALBSMS_URL = "http://www.jawalbsms.ws/api.php/sendsms";
    /** @var string */
    protected $username, $password, $senderName;
    /** @var Client */
    protected $client;
    /** @var array Client Options */
    protected $options = [];

    /**
     * SmsWrapper constructor.
     * @param $username
     * @param $password
     * @param $senderName
     * @param array $options
     */
    public function __construct($username, $password, $senderName, $options = []){
        $this->username = $username;
        $this->password = $password;
        $this->senderName = $senderName;
        $this->options = $options;

        !array_key_exists('headers', $this->options) && ($this->options['headers'] = []);
        $this->options['headers']['X-REQUEST-WITH'] = "Myth Jawalbsms Laravel Wrapper 1.0";
        $this->client = new Client($this->options);
    }

    /**
     * send new sms message to specific mobile numbers from jawalbsms
     * @param string $message
     * @param string|string[] $numbers
     * @return bool|string|null
     */
    public function sendSMS($message, $numbers){
        $numbers = MStr::saMobileNumber($numbers);
        if(!$message || !$numbers){
            return null;
        }
        try{
            $request = $this->client->get(
                static::JAWALBSMS_URL,
                [
                    'query' => [
                        'user'    => $this->username,
                        'pass'    => $this->password,
                        'to'      => $numbers,
                        'unicode' => 'u',
                        'message' => $message,
                        'sender'  => $this->senderName,
                    ],
                ]
            );
            $response = $request->getBody()->getContents();
        }
        catch(\Exception $exception){
            $response = "Unknown Error!";
        }

        return $this->serializeResponse($response);
    }

    /**
     * serialize client response
     * success return true
     * error return message error
     * @param string $body
     * @return bool|string
     */
    protected function serializeResponse($body = ''){
        $body = preg_replace('/[^\d+\-]/', "", $body);
        if(preg_match_all('/(MSG_ID)/', strtoupper($body))) return true;
        switch($body){
        case '-100':
            return "Missing parameters (not exist or empty) Username + password.";
        break;
        case '-110':
            return "Account not exist (wrong username or password).";
        break;
        case '-111':
            return "The account not activated.";
        break;
        case '-112':
            return "Blocked account.";
        break;
        case '-113':
            return "Not enough balance.";
        break;
        case '-114':
            return "The service not available for now.";
        break;
        case '-115':
            return "The sender not available (if user have no opened sender).";
        break;
        case '-116':
            return "Invalid sender name";
        break;
        case '-120':
            return "No destination addresses, or all destinations are not correct";
        break;

        default:
            return $body;
        break;
        }
    }
}