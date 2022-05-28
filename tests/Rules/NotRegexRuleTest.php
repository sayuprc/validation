<?php

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\NotRegexRule;

class NotRegexRuleTest extends TestCase
{
    private ?NotRegexRule $rule = null;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new NotRegexRule();
    }

    /**
     * 値が正規表現にマッチしない時、検証成功
     */
    public function testValidationSucceeded()
    {
        $this->assertTrue($this->rule->validate('!@#$%^&*()', '/\A[a-zA-Z0-9]+\z/'));
    }

    /**
     * 値が正規表現にマッチする時、検証失敗
     */
    public function testValidationFailed()
    {
        $this->assertFalse($this->rule->validate('abCD01', '/\A[a-zA-Z0-9]+\z/'));
    }
}
