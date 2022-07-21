<?php

declare(strict_types=1);

namespace Validation\Rules;

class RegexRule implements RuleInterface
{
    /**
     * 正規表現にマッチする
     *
     * @param mixed $value
     * @param mixed $parameters
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        return preg_match($parameters, $value) === 1 ? true : false;
    }
}
