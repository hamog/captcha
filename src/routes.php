<?php

if ((float) app()->version() >= 5.2) {
    Route::get('captcha', '\Hamog\Captcha\CaptchaController@getCaptcha')->middleware('web');
} else {
    Route::get('captcha', '\Hamog\Captcha\CaptchaController@getCaptcha');
}
