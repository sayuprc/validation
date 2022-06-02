<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\RegexRule;

class RegexRuleTest extends TestCase
{
    private RegexRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new RegexRule();
    }

    /**
     * 値が正規表現にマッチする時、検証成功
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        $this->assertTrue($this->rule->validate('abCD01', '/\A[a-zA-Z0-9]+\z/'));
    }

    /**
     * 値が正規表現にマッチしない時、検証失敗
     *
     * @return void
     */
    public function testValidationFailed(): void
    {
        $this->assertFalse($this->rule->validate('!@#$%^&*()', '/\A[a-zA-Z0-9]+\z/'));
    }
}
