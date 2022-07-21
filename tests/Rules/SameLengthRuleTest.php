<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\SameLengthRule;

class SameLengthRuleTest extends TestCase
{
    private SameLengthRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new SameLengthRule();
    }

    /**
     * 文字列長が指定と同じ時、検証成功
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        $this->assertTrue($this->rule->validate('', '0'));

        $this->assertTrue($this->rule->validate('s', '1'));
    }

    /**
     * 文字列長が指定と異なる時、検証成功
     *
     * @return void
     */
    public function testValidationFailed(): void
    {
        $this->assertFalse($this->rule->validate('s', '0'));

        $this->assertFalse($this->rule->validate('', '1'));
    }

    /**
     * 値がNULLの時、検証成功
     *
     * @return void
     */
    public function testValidationFailedWithNull(): void
    {
        $this->assertFalse($this->rule->validate(null, '4'));
    }
}
