<?php

declare(strict_types=1);

namespace Validation\Rules;

class SameLengthRule implements RuleInterface
{
    /**
     * 文字列長が指定と同じ
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
        } elseif (is_string($value) && mb_strlen($value) !== (int) $parameters) {
            return false;
        }

        return true;
    }
}
