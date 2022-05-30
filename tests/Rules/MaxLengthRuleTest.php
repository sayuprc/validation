<?php

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\MaxLengthRule;

class MaxLengthRuleTest extends TestCase
{
    private MaxLengthRule $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new MaxLengthRule();
    }

    /**
     * 文字列長が指定以下の時、検証成功
     */
    public function testValidationSucceeded()
    {
        $this->assertTrue($this->rule->validate('s', '1'));

        $this->assertTrue($this->rule->validate('st', '2'));
    }

    /**
     * 文字列長が指定より大きい時、検証失敗
     */
    public function testValidationFailed()
    {
        $this->assertFalse($this->rule->validate('st', '1'));

        $this->assertFalse($this->rule->validate('str', '2'));
    }

    /**
     * 値がNULLの時、検証失敗
     */
    public function testValidationFailedWithNull()
    {
        $this->assertFalse($this->rule->validate(null, '4'));
    }
}
