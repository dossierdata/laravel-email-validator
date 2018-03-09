<?php namespace Dossierdata\LaravelEmailValidator\Validation;

use Dossierdata\LaravelEmailValidator\Contracts\RuleFactory;
use Dossierdata\LaravelEmailValidator\Exceptions\InvalidValidationRuleException;
use Dossierdata\LaravelEmailValidator\Interfaces\Rule;
use Illuminate\Contracts\Validation\Validator;

class EmailValidator implements \Dossierdata\LaravelEmailValidator\Contracts\EmailValidator
{

    /**
     * @var array|string[]
     */
    protected $errors = [];
    /**
     * @var RuleFactory
     */
    protected $ruleFactory;

    /**
     * EmailValidator constructor.
     * @param RuleFactory $ruleFactory
     */
    public function __construct(RuleFactory $ruleFactory)
    {
        $this->ruleFactory = $ruleFactory;
    }


    /**
     * Validate all rules supplied in the parameters, if no rules are supplied in
     * the parameters the default behaviour is to check only RFC validation.
     *
     * @param mixed $value
     * @param array $rules
     * @return mixed
     * @throws InvalidValidationRuleException
     */
    public function validateValue($value, array $rules)
    {
        $checkedRules = [];

        foreach ($rules as $parameter) {
            $rule = $this->ruleFactory->createByParameter($parameter);

            if (!$this->checkRule($value, $rule, $checkedRules)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validate all rules supplied in the parameters, if no rules are supplied in
     * the parameters the default behaviour is to check only RFC validation.
     *
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @param Validator|null $validator
     * @return mixed
     * @throws InvalidValidationRuleException
     */
    public function validate($attribute, $value, array $parameters = ['rfc'], Validator $validator = null)
    {
        $checkedRules = [];

        foreach ($parameters as $parameter) {
            $rule = $this->ruleFactory->createByParameter($parameter);

            if (!$this->checkRule($value, $rule, $checkedRules, $attribute, $validator)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if the rule passes, if the rule has dependant rules which it has to
     * execute beforehand than check those as well in a recursive fashion.
     *
     * @param $attribute
     * @param $value
     * @param Rule $rule
     * @param $checkedRules
     * @param Validator|null $validator
     * @return bool
     */
    protected function checkRule($value, Rule $rule, &$checkedRules, $attribute = null, Validator $validator = null)
    {
        $prerequisiteRules = $rule->getPrerequisiteRules();
        $rulesToCheck = $this->getRulesToCheckBeforehand($prerequisiteRules, $checkedRules);

        foreach ($rulesToCheck as $ruleToCheck) {
            if (!$this->checkRule($value, $ruleToCheck, $checkedRules, $attribute, $validator)) {
                $this->addRuleErrorsToValidator($rule, $attribute, $validator);
                return false;
            }
        }

        if (!$rule->passes($attribute, $value)) {
            $this->addRuleErrorsToValidator($rule, $attribute, $validator);
            return false;
        }

        return true;
    }

    protected function addRuleErrorsToValidator(Rule $rule, $attribute, Validator $validator = null)
    {
        $this->errors[] = $rule->message();

        if (isset($validator) && isset($attribute)) {
            $validator->errors()->add($attribute, $rule->message());
        }
    }

    /**
     * Get an array of rules that need to pass before
     * we can check if the current one passes.
     *
     * @param $prerequisiteRules
     * @param $checkedRules
     * @return array
     */
    protected function getRulesToCheckBeforehand($prerequisiteRules, $checkedRules)
    {
        return array_intersect($prerequisiteRules, array_diff($prerequisiteRules, $checkedRules));
    }

    /**
     * Get all errors
     *
     * @return array|string[]
     */
    public function errors()
    {
        return $this->errors;
    }

}