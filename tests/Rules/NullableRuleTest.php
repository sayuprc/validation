<?php

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\NullableRule;

class NullableRuleTest extends TestCase
{
    private NullableRule $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new NullableRule();
    }

    /**
     * どんな値でも検証成功
     */
    public function testValidationSucceeded()
    {
        $this->assertTrue($this->rule->validate('string', ''));

        $this->assertTrue($this->rule->validate(0, ''));

        $this->assertTrue($this->rule->validate([0, 1, 2], ''));

        $this->assertTrue($this->rule->validate(null, ''));
    }
}
