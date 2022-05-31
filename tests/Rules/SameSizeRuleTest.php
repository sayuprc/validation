<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\SameSizeRule;

class SameSizeRuleTest extends TestCase
{
    private SameSizeRule $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new SameSizeRule();
    }

    /**
     * 文字列長が指定と同じ時、検証成功
     */
    public function testValidationSucceeded()
    {
        $this->assertTrue($this->rule->validate(0, '0'));

        $this->assertTrue($this->rule->validate(1, '1'));

        $this->assertTrue($this->rule->validate(-1, '-1'));
    }

    /**
     * 文字列長が指定と異なる時、検証成功
     */
    public function testValidationFailed()
    {
        $this->assertFalse($this->rule->validate(1, '0'));

        $this->assertFalse($this->rule->validate(0, '1'));

        $this->assertFalse($this->rule->validate(-2, '-1'));
    }

    /**
     * 値がNULLの時、検証成功
     */
    public function testValidationFailedWithNull()
    {
        $this->assertFalse($this->rule->validate(null, '4'));
    }
}
