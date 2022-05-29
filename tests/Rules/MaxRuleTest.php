<?php

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\MaxRule;

class MaxRuleTest extends TestCase
{
    private MaxRule $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new MaxRule();
    }

    /**
     * 数値が指定以下の時、検証成功
     */
    public function testValidationSucceeded()
    {
        $this->assertTrue($this->rule->validate(0, '0'));

        $this->assertTrue($this->rule->validate(0, '1'));

        $this->assertTrue($this->rule->validate(1, '2'));

        $this->assertTrue($this->rule->validate(-2, '-1'));
    }

    /**
     * 数値が指定より大きい時、検証失敗
     */
    public function testValidationFailed()
    {
        $this->assertFalse($this->rule->validate(2, '1'));

        $this->assertFalse($this->rule->validate(3, '2'));

        $this->assertFalse($this->rule->validate(0, '-1'));
    }

    /**
     * 値がNULLの時、検証失敗
     */
    public function testValidationFailedWithNull()
    {
        $this->assertFalse($this->rule->validate(null, '4'));
    }
}
