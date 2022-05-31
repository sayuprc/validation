<?php

declare(strict_types=1);

namespace Validation\Rules;

use Validation\ValidateData;

class RequiredWithoutAllRule implements RuleInterface
{
    private RequiredRule $rule;

    private ValidateData $data;

    public function __construct(RequiredRule $rule, ValidateData $data)
    {
        $this->rule = $rule;
        $this->data = $data;
    }

    /**
     * パラメータがすべて存在しない場合、必須
     *
     * @param mixed $value
     * @param mixed $parameters
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        if (! $this->data->existsAny(explode(',', $parameters))) {
            return $this->rule->validate($value, $parameters);
        }

        return true;
    }
}
