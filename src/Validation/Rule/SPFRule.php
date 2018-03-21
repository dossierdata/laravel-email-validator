<?php

namespace Dossierdata\LaravelEmailValidator\Validation\Rule;

use Egulias\EmailValidator\EmailParser;
use Mika56\SPFCheck\DNSRecordGetter;
use Mika56\SPFCheck\SPFCheck;

class SPFRule extends Rule
{

    /**
     * @var string|null
     */
    protected $tag = 'spf';
    /**
     * @var array|string[]
     */
    protected $prerequisiteRules = [
        'rfc'
    ];
    /**
     * @var DNSRecordGetter
     */
    protected $dnsRecordGetter;
    /**
     * @var SPFCheck
     */
    protected $spfChecker;
    /**
     * @var string
     */
    protected $error = null;
    /**
     * @var string
     */
    protected $result = null;
    /**
     * @var EmailParser
     */
    protected $emailParser;

    public function __construct(DNSRecordGetter $dnsRecordGetter, EmailParser $emailParser)
    {
        $this->dnsRecordGetter = $dnsRecordGetter;
        $this->spfChecker = new SPFCheck($this->dnsRecordGetter);
        $this->emailParser = $emailParser;
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
        $parts = $this->emailParser->parse((string)$value);

        if (!isset($parts['domain'])) {
            $this->error = sprintf('Could not parse the domain from "%s" while trying to validate SPF', $value);
            return false;
        }

        $this->result = $this->spfChecker->isIPAllowed($this->options, $parts['domain']);

        return $this->result == SPFCheck::RESULT_PASS;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->error !== null) {
            return $this->error;
        }

        switch ($this->result) {
            case SPFCheck::RESULT_FAIL:
                return sprintf(
                    'SPF configured incorrectly for "%s", spam filters will block mail from this account',
                    $this->options
                );
            case SPFCheck::RESULT_SOFTFAIL:
                return sprintf(
                    'SPF has not been configured (correctly) for "%s", spam filters will most likely block mail from this account',
                    $this->options
                );
            case SPFCheck::RESULT_NEUTRAL:
            case SPFCheck::RESULT_NONE:
                return sprintf(
                    'It is unknown whether SPF is configured correctly for "%s", spam filter might block mail from this account',
                    $this->options
                );
            case SPFCheck::RESULT_PERMERROR:
            case SPFCheck::RESULT_TEMPERROR:
            case SPFCheck::RESULT_DEFINITIVE_PERMERROR:
                return sprintf('Could not verify SPF settings for "%s"', $this->options);
            default:
                return 'Unknown SPF validation error';
        }
    }
}
