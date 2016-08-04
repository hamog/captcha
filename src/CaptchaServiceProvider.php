<?php

namespace Hamog\Captcha;

use Illuminate\Support\ServiceProvider;
/**
 * Class CaptchaServiceProvider
 * @package Hamog\Captcha
 * @author Hashem Moghaddari
 */
class CaptchaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration files
        $this->publishes([
            __DIR__.'/../config/captcha.php' => config_path('captcha.php')
        ], 'config');

        // HTTP routing
        $this->app['router']->get('captcha', '\Hamog\Captcha\CaptchaController@getCaptcha')->middleware('web');

        // Validator extensions
        $this->app['validator']->extend('captcha', function($attribute, $value, $parameters)
        {
            return \Captcha::check($value);
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Bind captcha class
        $this->app->bind('captcha', function() {
            return new Captcha();
        });
    }
}
