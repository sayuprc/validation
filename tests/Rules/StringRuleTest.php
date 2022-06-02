<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\StringRule;

class StringRuleTest extends TestCase
{
    private StringRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new StringRule();
    }

    /**
     * 値が文字列の時、検証成功
     *
     * @return void
     */
    public function testValidationSucceededWithString(): void
    {
        $this->assertTrue($this->rule->validate('string', ''));

        // 文字列長は0でもよい
        $this->assertTrue($this->rule->validate('', ''));
    }

    /**
     * 値が配列の時、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithArray(): void
    {
        $this->assertFalse($this->rule->validate([0, 1, 2], ''));
    }

    /**
     * 値が数値の時、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithNumeric(): void
    {
        $this->assertFalse($this->rule->validate(1, ''));
    }

    /**
     * 値がNULL値の時、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithNull(): void
    {
        $this->assertFalse($this->rule->validate(null, ''));
    }
}
