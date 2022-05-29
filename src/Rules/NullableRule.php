<?php

namespace Validation\Rules;

class NullableRule implements RuleInterface
{
    /**
     * すべてtrue
     *
     * @param mixed $value
     * @param mixed $parameter
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        return true;
    }
}
