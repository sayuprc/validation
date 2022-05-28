<?php

namespace Validation\Rules;

class ArrayRule implements RuleInterface
{
    /**
     * 値が配列である
     *
     * @param mixed $value
     * @param mixed $parameter
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        return is_array($value);
    }
}
