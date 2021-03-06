<?php

declare(strict_types=1);

namespace Validation\Rules;

class StringRule implements RuleInterface
{
    /**
     * 値が文字列である
     *
     * @param mixed $value
     * @param mixed $parameters
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        return is_string($value);
    }
}
