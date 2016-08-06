<?php

namespace Hamog\Captcha;
/**
 * Class Captcha
 * @package Hamog\Captcha
 * @author hashem Moghaddari <hashemm364@gmail.com>
 */
class Captcha
{
    /**
     * Image resource
     *
     * @var resource
     */
    protected $img;

    /**
     * Image width
     *
     * @var int
     */
    protected $width;

    /**
     * Image height
     *
     * @var int
     */
    protected $height;

    /**
     * Image Background color
     *
     * @var string
     */
    protected $backColor;

    /**
     * Image Font color
     *
     * @var string
     */
    protected $fontColor;

    /**
     * Image font file path
     *
     * @var string
     */
    protected $font;

    /**
     * Image font size
     *
     * @var int
     */
    protected $size;

    /**
     * Length of captcha code
     *
     * @var int
     */
    protected $length;

    /**
     * Set attributes values
     *
     * @return void
     */
    protected function configure()
    {
        if (config()->has('captcha'))
        {
            foreach(config('captcha') as $key => $value)
            {
                $key = camel_case($key);
                $this->{$key} = $value;
            }
        }
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $this->backColor = imagecolorallocate($this->img, 255, 255, 255); //white
        $this->fontColor = imagecolorallocate($this->img, $this->hex2rgb()[0], $this->hex2rgb()[1], $this->hex2rgb()[2]);
        $this->font = __DIR__.'/../assets/font/arial.ttf';
    }

    /**
     * Generate random text
     *
     * @return string
     */
    protected function randomText()
    {
        $alphaNumeric = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        $text = '';
        for ($i=0; $i < $this->length; $i++) {
            $text .= $alphaNumeric[rand(0, count($alphaNumeric) -1)];
        }
        //put captcha code into session
        session(['captcha' => $text]);

        return $text;
    }

    /**
     * Convert Hexadecimal to RGB font color
     *
     * @return array
     */
    protected function hex2rgb() {
        $hex = str_replace("#", "", $this->fontColor);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    /**
     * Create captcha image
     */
    public function create()
    {
        $this->configure();

        imagefilledrectangle($this->img, 0, 0, $this->width, $this->height, $this->backColor);
        imagettftext ($this->img, $this->size, -5, 10, 40, $this->fontColor, $this->font, $this->randomText());
        header("Content-type: image/png");
        imagepng($this->img);
    }

    /**
     * Generate captcha image html tag
     *
     * @return string img HTML Tag
     */
    public function img()
    {
        return '<img src="' . $this->src() . '" alt="captcha">';
    }

    /**
     * Check user input captcha code
     *
     * @param string $input
     *
     * @return bool
     */
    public function check($input)
    {
        if ( ! session()->has('captcha')) {
            return false;
        }

        $code = session()->pull('captcha');

        if(config('captcha.sensitive')) {
            if ($input == $code) {
                return true;
            } else {
                return false;
            }
        } else {
            if (strtolower($input) == strtolower($code)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Generate captcha image source
     *
     * @return string
     */
    public function src()
    {
        return url('captcha') . '?' . str_random(8);
    }
}
