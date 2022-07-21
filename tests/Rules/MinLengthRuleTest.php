<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\MinLengthRule;

class MinLengthRuleTest extends TestCase
{
    private MinLengthRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new MinLengthRule();
    }

    /**
     * 文字列長が指定以上の時、検証成功
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        $this->assertTrue($this->rule->validate('s', '1'));

        $this->assertTrue($this->rule->validate('st', '1'));
    }

    /**
     * 文字列長が指定より小さい時、検証失敗
     *
     * @return void
     */
    public function testValidationFailed(): void
    {
        $this->assertFalse($this->rule->validate('', '1'));

        $this->assertFalse($this->rule->validate('s', '2'));
    }

    /**
     * 値がNULLの時、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithNull(): void
    {
        $this->assertFalse($this->rule->validate(null, '4'));
    }
}
