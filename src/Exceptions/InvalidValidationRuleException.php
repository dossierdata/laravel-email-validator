<?php namespace Dossierdata\LaravelEmailValidator\Exceptions;

class InvalidValidationRuleException extends \Exception
{

    public function __construct($rule)
    {
        parent::__construct(sprintf('The email validation rule "%s" can not be found', $rule));
    }

}