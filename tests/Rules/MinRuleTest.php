<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\MinRule;

class MinRuleTest extends TestCase
{
    private MinRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new MinRule();
    }

    /**
     * 数値が指定以上の時、検証成功
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        $this->assertTrue($this->rule->validate(1, '1'));

        $this->assertTrue($this->rule->validate(2, '1'));

        $this->assertTrue($this->rule->validate(-2, '-3'));
    }

    /**
     * 数値が指定より小さい時、検証失敗
     *
     * @return void
     */
    public function testValidationFailed(): void
    {
        $this->assertFalse($this->rule->validate(0, '1'));

        $this->assertFalse($this->rule->validate(-4, '-3'));
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
