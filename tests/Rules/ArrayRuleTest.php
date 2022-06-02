<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\ArrayRule;

class ArrayRuleTest extends TestCase
{
    private ArrayRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new ArrayRule();
    }

    /**
     * 値が配列の時、検証成功
     *
     * @return void
     */
    public function testValidationSucceededWithArray(): void
    {
        $this->assertTrue($this->rule->validate([0, 1, 2], ''));

        // 配列長は0でもよい
        $this->assertTrue($this->rule->validate([], ''));
    }

    /**
     * 値が文字列の時、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithString(): void
    {
        $this->assertFalse($this->rule->validate('array', ''));
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
