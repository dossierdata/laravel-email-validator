<?php

namespace Dossierdata\LaravelEmailValidator\Contracts;

use Dossierdata\LaravelEmailValidator\Exceptions\InvalidValidationRuleException;
use Dossierdata\LaravelEmailValidator\Interfaces\Rule;

interface RuleFactory
{
    /**
     * @param $tag
     *
     * @throws InvalidValidationRuleException
     *
     * @return Rule
     */
    public function createByTag($tag);

    /**
     * @param $parameter
     *
     * @throws InvalidValidationRuleException
     *
     * @return Rule
     */
    public function createByParameter($parameter);
}
