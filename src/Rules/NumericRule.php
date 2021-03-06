<?php

declare(strict_types=1);

namespace Validation\Rules;

class NumericRule implements RuleInterface
{
    /**
     * 値が数値である
     *
     * @param mixed $value
     * @param mixed $parameters
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        return is_numeric($value);
    }
}
