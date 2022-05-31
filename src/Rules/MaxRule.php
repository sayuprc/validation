<?php

declare(strict_types=1);

namespace Validation\Rules;

class MaxRule implements RuleInterface
{
    /**
     * 数値が指定より小さい
     *
     * @param mixed $value
     * @param mixed $parameter
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        if (! is_numeric($value)) {
            return false;
        } elseif (is_numeric($value) && $parameters < $value) {
            return false;
        }

        return true;
    }
}
