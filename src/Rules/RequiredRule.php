<?php

declare(strict_types=1);

namespace Validation\Rules;

class RequiredRule implements RuleInterface
{
    /**
     * 必須
     *
     * 下記値を許容しない
     *
     * - NULL
     * - 空文字
     * - count()の値が0以下
     *
     * @param mixed  $value
     * @param string $parameter
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool
    {
        if ($value === null) {
            return false;
        } elseif (is_string($value) && trim($value) === '') {
            return false;
        } elseif (is_countable($value) && count($value) <= 0) {
            return false;
        }

        return true;
    }
}
