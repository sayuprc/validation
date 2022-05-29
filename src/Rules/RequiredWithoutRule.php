<?php

namespace Validation\Rules;

use Validation\ValidateData;

class RequiredWithoutRule implements RuleInterface
{
    private RequiredRule $rule;

    private ValidateData $data;

    public function __construct(RequiredRule $rule, ValidateData $data)
    {
        $this->rule = $rule;
        $this->data = $data;
    }

    /**
     * パラメータが一つでも存在しない場合、必須
     *
     * @param mixed $value
     * @param mixed $parameters
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        if (! $this->data->existsAll(explode(',', $parameters))) {
            return $this->rule->validate($value, $parameters);
        }

        return true;
    }
}
