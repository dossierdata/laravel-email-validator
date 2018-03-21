<?php namespace Dossierdata\LaravelEmailValidator\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = new \Illuminate\Foundation\Application(
            realpath(__DIR__ . '/../src/')
        );

        $app->singleton(
            'Illuminate\Contracts\Http\Kernel',
            'App\Http\Kernel'
        );

        $app->singleton(
            'Illuminate\Contracts\Console\Kernel',
            'App\Console\Kernel'
        );

        $app->singleton(
            'Illuminate\Contracts\Debug\ExceptionHandler',
            'App\Exceptions\Handler'
        );

        $app->register(\Dossierdata\LaravelEmailValidator\ServiceProvider::class);

        return $app;
    }
}
