<?php

namespace Dossierdata\LaravelEmailValidator\Interfaces;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;

interface Validator
{
    public function validateValue($value, array $rules);

    /**
     * @param string            $attribute
     * @param ValidatorContract $validator
     */
    public function validate($attribute, $value, array $parameters, ValidatorContract $validator = null);
}
