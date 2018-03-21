<?php

namespace Dossierdata\LaravelEmailValidator\Validation\Rule;

use Dossierdata\LaravelEmailValidator\Contracts\RuleFactory;

abstract class Rule implements \Dossierdata\LaravelEmailValidator\Interfaces\Rule
{

    /**
     * @var string|null
     */
    protected $tag = null;
    /**
     * @var string|null
     */
    protected $ruleFactory = null;
    /**
     * @var string|null
     */
    protected $options = null;
    /**
     * @var array|string[]
     */
    protected $prerequisiteRules = [];

    /**
     * @param $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return array|Rule[]
     * @throws \Dossierdata\LaravelEmailValidator\Exceptions\InvalidValidationRuleException
     */
    public function getPrerequisiteRules()
    {
        $rules = [];

        foreach ($this->prerequisiteRules as $tag) {
            $rules[] = $this->getRuleFactory()->createByTag($tag);
        }

        return $rules;
    }

    /**
     * @return RuleFactory
     */
    private function getRuleFactory()
    {
        return app()->make(RuleFactory::class);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->tag;
    }
}
