<?php

namespace Myth\Support\JawalBSms\Providers;

use Illuminate\Support\ServiceProvider;
use Myth\Support\JawalBSms\SmsWrapper;

/**
 * Class JawalBSmsProvider
 * @package Myth\Support\JawalBSms\Providers
 */
class JawalBSmsProvider extends ServiceProvider{

    /** @var string */
    protected $abstract = 'myth.support.jawalbsms';

    /** @var array Config data */
    protected $configData = [
        'path'        => __DIR__.'/../../config/jawalbsms.php',
        'key'         => "jawalbsms",
        'publishFile' => "jawalbsms.php",
    ];

    /**
     * Register services.
     * @return void
     */
    public function register(){
        $this->mergeConfigFrom($this->configData['path'], $this->configData['key']);
        foreach(glob(__DIR__.'/../Helpers/*.php') as $file){
            require_once($file);
        }

        $this->app->singleton(
            $this->abstract,
            function($app){
                $config = $app['config']->get($this->configData['key']);
                return new SmsWrapper(
                    $config['username'], $config['password'], $config['sender_name'], $config['options']
                );
            }
        );
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot(){
        $this->publishes([$this->configData['path'] => config_path($this->configData['publishFile'])], 'config');
    }

    /**
     * @return array
     */
    public function provides(){
        return ['jawalbsms'];
    }
}
