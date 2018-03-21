<?php

namespace Dossierdata\LaravelEmailValidator\Factories;

use Dossierdata\LaravelEmailValidator\Exceptions\InvalidValidationRuleException;
use Dossierdata\LaravelEmailValidator\Interfaces\Rule;
use Illuminate\Contracts\Container\Container;

class RuleFactory implements \Dossierdata\LaravelEmailValidator\Contracts\RuleFactory
{
    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $tag
     *
     * @throws InvalidValidationRuleException
     *
     * @return Rule
     */
    public function createByTag($tag)
    {
        if (!starts_with($tag, 'dossierdata.email.rule.')) {
            $tag = sprintf('dossierdata.email.rule.%s', $tag);
        }

        if (!$this->container->bound($tag)) {
            throw new InvalidValidationRuleException($tag);
        }

        /** @var Rule $rule */
        $rule = $this->container->make($tag);

        return $rule;
    }

    /**
     * @param $parameter
     *
     * @throws InvalidValidationRuleException
     *
     * @return Rule
     */
    public function createByParameter($parameter)
    {
        if (str_contains($parameter, ':')) {
            list($tag, $options) = explode(':', $parameter);
        } else {
            $tag = $parameter;
        }

        $rule = $this->createByTag($tag);

        if (isset($options)) {
            $rule->setOptions($options);
        }

        return $rule;
    }
}
