<?php

namespace Dossierdata\LaravelEmailValidator;

use Illuminate\Contracts\Support\DeferrableProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            \Dossierdata\LaravelEmailValidator\Contracts\RuleFactory::class,
            \Dossierdata\LaravelEmailValidator\Contracts\EmailValidator::class,
            'dossierdata.email.rule.rfc',
            'dossierdata.email.rule.rfc_no_warnings',
            'dossierdata.email.rule.spf',
            'dossierdata.email.rule.dns',
            'dossierdata.email.rules'
        ];
    }
}
