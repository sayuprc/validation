<?php

namespace Validation\Rules;

class NotRegexRule implements RuleInterface
{
    /**
     * 正規表現にマッチしない
     *
     * @param mixed $value
     * @param mixed $parameter
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        return ! preg_match($parameters, $value);
    }
}
