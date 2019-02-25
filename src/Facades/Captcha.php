<?php

namespace Hamog\Captcha\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Get the registered Captcha class.
 */
class Captcha extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'captcha';
    }
}
