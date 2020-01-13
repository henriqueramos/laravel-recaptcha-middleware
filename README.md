# laravel-recaptcha-middleware
=========

Laravel reCaptcha Middleware it's a Composer package created to help us to validate reCaptcha payloads during the initial steps of request lifecycle.

## Installation

Add the following line to the `require` section of `composer.json`:

```json
{
    "require": {
        "henriqueramos/recaptcha_middleware": "dev-master"
    }
}
```

## Setup

1. Run `php artisan vendor:publish --provider="RamosHenrique\reCaptchaMiddleware"`.
2. In your .env, enter your reCAPTCHA private key as value for `RECAPTCHA_MIDDLEWARE_SECRET_KEY` and `RECAPTCHA_MIDDLEWARE_RESPONSE_TYPE` as `json` or `html`.

## Usage

Add into your selected routes the middleware `recaptcha_middleware`.
```php
$this->router->post(
    'myProtectedRoute',
    [
        'as' => 'my.protected.route',
        'uses' => 'ProtectedRouteController@necessaryMethod',
    ]
)
->middleware('recaptcha_middleware');
```
