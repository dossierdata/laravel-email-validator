<?php namespace Dossierdata\LaravelEmailValidator\Contracts;

use Dossierdata\LaravelEmailValidator\Exceptions\InvalidValidationRuleException;
use Dossierdata\LaravelEmailValidator\Interfaces\Rule;

interface RuleFactory
{

    /**
     * @param $tag
     * @return Rule
     * @throws InvalidValidationRuleException
     */
    public function createByTag($tag);

    /**
     * @param $parameter
     * @return Rule
     * @throws InvalidValidationRuleException
     */
    public function createByParameter($parameter);

}