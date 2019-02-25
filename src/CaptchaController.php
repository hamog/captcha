<?php

namespace Hamog\Captcha;

use App\Http\Controllers\Controller;

/**
 * Class CaptchaController.
 */
class CaptchaController extends Controller
{
    /**
     * Get captcha image.
     *
     * @param Captcha $captcha
     */
    public function getCaptcha(Captcha $captcha)
    {
        return $captcha->create();
    }
}
