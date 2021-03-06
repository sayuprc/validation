<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\NumericRule;

class NumericRuleTest extends TestCase
{
    private NumericRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new NumericRule();
    }

    /**
     * 値が数値の時、検証成功
     *
     * @return void
     */
    public function testValidationSucceededWithNumeric(): void
    {
        // 正の数
        $this->assertTrue($this->rule->validate(1, ''));

        // 0
        $this->assertTrue($this->rule->validate(0, ''));

        // 負の数
        $this->assertTrue($this->rule->validate(-1, ''));

        // 少数
        $this->assertTrue($this->rule->validate(10.5, ''));
    }

    /**
     * 値が文字列の時、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithString(): void
    {
        $this->assertFalse($this->rule->validate('string', ''));
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
     * 値がNULL値の時、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithNull(): void
    {
        $this->assertFalse($this->rule->validate(null, ''));
    }
}
