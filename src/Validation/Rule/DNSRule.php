<?php namespace Dossierdata\LaravelEmailValidator\Validation\Rule;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;

class DNSRule extends Rule
{

    /**
     * @var string|null
     */
    protected $tag = 'dns';
    /**
     * @var EmailValidator
     */
    protected $emailValidator;

    public function __construct(EmailValidator $emailValidator)
    {
        $this->emailValidator = $emailValidator;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->emailValidator->isValid($value, new DNSCheckValidation());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->emailValidator->getError()->getMessage();
    }
}