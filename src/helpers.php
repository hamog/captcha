<?php

if ( ! function_exists('captcha')) {

    /**
     * Return Image
     *
     * @return resource
     */
    function captcha()
    {
        return app('captcha')->create();
    }
}

if ( ! function_exists('captcha_src')) {
    /**
     * Return Image URL
     *
     * @return string
     */
    function captcha_src()
    {
        return app('captcha')->src();
    }
}

if ( ! function_exists('captcha_img')) {

    /**
     * Return Captcha HTML image
     *
     * @return mixed
     */
    function captcha_img()
    {
        return app('captcha')->img();
    }
}


if ( ! function_exists('captcha_check')) {
    /**
     * Check captcha
     *
     * @param $value
     * @return bool
     */
    function captcha_check($value)
    {
        return app('captcha')->check($value);
    }
}