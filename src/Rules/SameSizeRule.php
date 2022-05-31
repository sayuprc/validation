<?php

declare(strict_types=1);

namespace Validation\Rules;

class SameSizeRule implements RuleInterface
{
    /**
     * 数値が指定と同じ
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
        } elseif (is_numeric($value) && $value !== (int) $parameters) {
            return false;
        }

        return true;
    }
}
