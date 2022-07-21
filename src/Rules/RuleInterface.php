<?php

declare(strict_types=1);

namespace Validation\Rules;

interface RuleInterface
{
    /**
     * 検証実行
     *
     * @param mixed $value
     * @param mixed $parameters
     *
     * @return bool
     */
    public function validate(mixed $value, mixed $parameters): bool;
}
