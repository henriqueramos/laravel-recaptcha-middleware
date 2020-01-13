<?php declare(strict_types = 1);

namespace RamosHenrique\reCaptchaMiddleware;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->publishes(
            [
            __DIR__.'/../config/recaptcha_middleware.php' => config_path('recaptcha_middleware.php'),
            ],
            'recaptcha-middleware-config'
        );

        $this->app['router']->aliasMiddleware(
            'recaptcha_middleware',
            Middleware::class
        );
    }

    /**
    * Make config publishment optional by merging the config from the package.
    *
    * @return  void
    */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/recaptcha_middleware.php',
            'recaptcha_middleware'
        );
    }
}
