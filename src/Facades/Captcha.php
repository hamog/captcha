<?php

namespace Hamog\Captcha\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Get the registered Captcha class
 *
 * @package Hamog\Captcha\Facades
 */
class Captcha extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor() { return 'captcha'; }
}