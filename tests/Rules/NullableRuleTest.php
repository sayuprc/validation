<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\NullableRule;

class NullableRuleTest extends TestCase
{
    private NullableRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new NullableRule();
    }

    /**
     * どんな値でも検証成功
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        $this->assertTrue($this->rule->validate('string', ''));

        $this->assertTrue($this->rule->validate(0, ''));

        $this->assertTrue($this->rule->validate([0, 1, 2], ''));

        $this->assertTrue($this->rule->validate(null, ''));
    }
}
