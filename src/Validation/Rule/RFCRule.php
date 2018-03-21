<?php

namespace Dossierdata\LaravelEmailValidator\Validation\Rule;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class RFCRule extends Rule
{
    /**
     * @var string|null
     */
    protected $tag = 'rfc';
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
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->emailValidator->isValid($value, new RFCValidation());
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
