<?php

namespace Dossierdata\LaravelEmailValidator\Interfaces;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;

interface Validator
{

    /**
     * @param mixed $value
     * @param array $rules
     * @return mixed
     */
    public function validateValue($value, array $rules);

    /**
     * @param string            $attribute
     * @param mixed             $value
     * @param array             $parameters
     * @param ValidatorContract $validator
     * @return mixed
     */
    public function validate($attribute, $value, array $parameters, ValidatorContract $validator = null);
}
