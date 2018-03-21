<?php

namespace Dossierdata\LaravelEmailValidator\Contracts;

use Dossierdata\LaravelEmailValidator\Interfaces\Validator;

interface EmailValidator extends Validator
{

    /**
     * Get all errors.
     *
     * @return array|string[]
     */
    public function errors();
}
