<?php

declare(strict_types=1);

namespace Validation\Rules;

class MinLengthRule implements RuleInterface
{
    /**
     * 文字長が指定以上
     *
     * @param mixed $value
     * @param mixed $parameters
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        if (! is_string($value)) {
            return false;
        } elseif (is_string($value) && mb_strlen($value) < $parameters) {
            return false;
        }

        return true;
    }
}
