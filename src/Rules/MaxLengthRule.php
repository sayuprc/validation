<?php

declare(strict_types=1);

namespace Validation\Rules;

class MaxLengthRule implements RuleInterface
{
    /**
     * 文字長が指定より小さい
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
        } elseif (is_string($value) && $parameters < mb_strlen($value)) {
            return false;
        }

        return true;
    }
}
