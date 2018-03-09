<?php namespace Dossierdata\LaravelEmailValidator\Tests\Unit;

use Dossierdata\LaravelEmailValidator\Contracts\EmailValidator;
use Dossierdata\LaravelEmailValidator\Tests\TestCase;

class ValidatorTest extends TestCase
{

    /**
     * @return EmailValidator
     */
    private function getEmailValidator()
    {
        return $this->app->make(EmailValidator::class);
    }

    /**
     * Data provider for testRFCValidation
     * variables are in the order of
     * $email, $rule, $expected, $errors
     *
     * @return array
     */
    public function rfcValidationProvider()
    {
        return [
            [
                'rfc_valid@email.com',
                [
                    'rfc'
                ],
                true,
            ],
            [
                'nodomainpart.com',
                [
                    'rfc'
                ],
                false,
                [
                    'No Domain part'
                ],
            ],
            [
                '@nodomainpart.com',
                [
                    'rfc'
                ],
                false,
                [
                    'No local part'
                ],
            ],
            [
                '.rfc_invalid@email.com',
                [
                    'rfc'
                ],
                false,
                [
                    'Found DOT at start'
                ],
            ],
            [
                'rfc_invalid@email.com.',
                [
                    'rfc'
                ],
                false,
                [
                    'Dot at the end'
                ],
            ],
            [
                '.rfc_invalid_prerequisite_rule@email.com',
                [
                    'spf:127.0.0.1'
                ],
                false,
                [
                    'Found DOT at start',
                    'Unknown SPF validation error'
                ],
            ],
            [
                'my@email.com',
                [
                    'spf:127.0.0.1'
                ],
                false,
                [
                    'SPF configured incorrectly for "127.0.0.1", spam filters will block mail from this account'
                ],
            ],
            [
                'spf_not_configured@google.com',
                [
                    'spf:127.0.0.1'
                ],
                false,
                [
                    'SPF has not been configured (correctly) for "127.0.0.1", spam filters will most likely block mail from this account'
                ],
            ],
            [
                'email@non-3xistent-domain.com',
                [
                    'dns',
                ],
                false,
                [
                    'No MX or A DSN record was found for this email'
                ],
            ],
            [
                'email@google.com',
                [
                    'dns',
                ],
                true,
            ],
        ];
    }

    /**
     * Test that the CSVReader can handle reading a simple row with only strings and numbers no enclosures.
     * @param $email
     * @param array $rules
     * @param $expected
     * @param array $errors
     * @return void
     *
     * @dataProvider rfcValidationProvider
     */
    public function testRFCValidation($email, array $rules, $expected, array $errors = [])
    {
        $validator = $this->getEmailValidator();

        $this->assertEquals($expected, $validator->validateValue($email, $rules));
        $this->assertEquals($errors, $validator->errors());
    }

}