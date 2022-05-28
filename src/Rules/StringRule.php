<?php

namespace Validation\Rules;

class StringRule implements RuleInterface
{
    /**
     * 値が文字列である
     *
     * @param mixed $value
     * @param mixed $parameter
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        return is_string($value);
    }
}
