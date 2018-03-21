<?php

namespace Dossierdata\LaravelEmailValidator\Exceptions;

class ValidationException extends \Illuminate\Validation\ValidationException
{
    public function __construct(
        \Illuminate\Contracts\Validation\Validator $validator,
        $response = null
    ) {
        parent::__construct($validator, $response);
    }
}
