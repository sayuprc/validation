<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\SameLengthRule;

class SameLengthRuleTest extends TestCase
{
    private SameLengthRule $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new SameLengthRule();
    }

    /**
     * 文字列長が指定と同じ時、検証成功
     */
    public function testValidationSucceeded()
    {
        $this->assertTrue($this->rule->validate('', '0'));

        $this->assertTrue($this->rule->validate('s', '1'));
    }

    /**
     * 文字列長が指定と異なる時、検証成功
     */
    public function testValidationFailed()
    {
        $this->assertFalse($this->rule->validate('s', '0'));

        $this->assertFalse($this->rule->validate('', '1'));
    }

    /**
     * 値がNULLの時、検証成功
     */
    public function testValidationFailedWithNull()
    {
        $this->assertFalse($this->rule->validate(null, '4'));
    }
}
