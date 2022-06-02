<?php

declare(strict_types=1);

namespace Validation\Rules;

class ArrayRule implements RuleInterface
{
    /**
     * 値が配列である
     *
     * @param mixed $value
     * @param mixed $parameters
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        return is_array($value);
    }
}
