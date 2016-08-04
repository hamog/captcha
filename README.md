# captcha
##Simple Captcha for laravel 5

###Installation

Require this package with composer:
```
composer require hamog/captcha
```

Find the providers key in config/app.php and register the Captcha Service Provider.
```php
'providers' => [
    // ...
    Hamog\Captcha\CaptchaServiceProvider::class,
]
```

Find the aliases key in config/app.php.
```php
'aliases' => [
    // ...
    'Captcha' => Hamog\Captcha\Facades\Captcha::class,
]
```

###Configuration

To use your own settings, publish config.
```
php artisan vendor:publish
```

To use your own settings in config/captcha.php, publish config.
```php
return [
    'width'         => 170,
    'height'        => 60,
    'font_color'    => '#1A3EA1', //only hexadecimal
    'size'          => 22,
    'length'        => 6,
    'sensitive'     => false,
];
```

###Preview

![captcha-preview](https://github.com/hamog/captcha/blob/master/assets/img/captcha.png)

###Usage

return captcha image:
```php
{!! Captcha::create() !!}

//Or
{!! captcha() !!}
```

Create html image tag:
```php
{!! Captcha::img() !!}

//Or
{!! captcha_img() !!}
```

return captcha src:
```php
{!! Captcha::src() !!}

//Or
{!! captcha_src() !!}
```

###Validation

Using captcha rule:
```php
'captcha'   => 'required|captcha',
```

Add custom rule message:
```php
'captcha' => 'The :attribute is invalid',
```

