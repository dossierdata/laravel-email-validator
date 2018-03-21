<?php

namespace Dossierdata\LaravelEmailValidator\Interfaces;

interface Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value);

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message();

    /**
     * @param string $options
     */
    public function setOptions($options);

    /**
     * @param array|string[]
     */
    public function getPrerequisiteRules();
}
