<?php

namespace Dossierdata\LaravelEmailValidator;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerValidationRules($this->app['validator']);
    }

    protected function registerValidationRules(\Illuminate\Contracts\Validation\Factory $validator)
    {
        $validator->extend('email_validator', 'Dossierdata\LaravelEmailValidator\Validation\EmailValidator@validate');
    }
}
