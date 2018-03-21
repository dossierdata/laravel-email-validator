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

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(
            \Dossierdata\LaravelEmailValidator\Contracts\RuleFactory::class,
            \Dossierdata\LaravelEmailValidator\Factories\RuleFactory::class
        );
        $this->app->bind(
            \Dossierdata\LaravelEmailValidator\Contracts\EmailValidator::class,
            \Dossierdata\LaravelEmailValidator\Validation\EmailValidator::class
        );
        $this->app->bind(
            'dossierdata.email.rule.rfc',
            \Dossierdata\LaravelEmailValidator\Validation\Rule\RFCRule::class
        );
        $this->app->bind(
            'dossierdata.email.rule.rfc_no_warnings',
            \Dossierdata\LaravelEmailValidator\Validation\Rule\RFCRule::class
        );
        $this->app->bind(
            'dossierdata.email.rule.spf',
            \Dossierdata\LaravelEmailValidator\Validation\Rule\SPFRule::class
        );
        $this->app->bind(
            'dossierdata.email.rule.dns',
            \Dossierdata\LaravelEmailValidator\Validation\Rule\DNSRule::class
        );

        $this->app->tag('dossierdata.email.rules', [
            'dossierdata.email.rule.rfc',
            'dossierdata.email.rule.rfc_no_warnings',
            'dossierdata.email.rule.spf',
            'dossierdata.email.rule.dns',
        ]);
    }
}
