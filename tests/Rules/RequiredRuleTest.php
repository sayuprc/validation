<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\RequiredRule;

class RequiredRuleTest extends TestCase
{
    private RequiredRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new RequiredRule();
    }

    /**
     * 値がNULLや空白文字以外の時、検証成功
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        $this->assertTrue($this->rule->validate('string', ''));

        $this->assertTrue($this->rule->validate(0, ''));

        $this->assertTrue($this->rule->validate([0, 1, 2], ''));
    }

    /**
     * 値が空文字の時、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithEmpty(): void
    {
        $this->assertFalse($this->rule->validate('', ''));
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
