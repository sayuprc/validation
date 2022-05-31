<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\RequiredRule;

class RequiredRuleTest extends TestCase
{
    private RequiredRule $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new RequiredRule();
    }

    /**
     * 値がNULLや空白文字以外の時、検証成功
     */
    public function testValidationSucceeded()
    {
        $this->assertTrue($this->rule->validate('string', ''));

        $this->assertTrue($this->rule->validate(0, ''));

        $this->assertTrue($this->rule->validate([0, 1, 2], ''));
    }

    /**
     * 値が空文字の時、検証失敗
     */
    public function testValidationFailedWithEmpty()
    {
        $this->assertFalse($this->rule->validate('', ''));
    }

    /**
     * 値がNULL値の時、検証失敗
     */
    public function testValidationFailedWithNull()
    {
        $this->assertFalse($this->rule->validate(null, ''));
    }
}
