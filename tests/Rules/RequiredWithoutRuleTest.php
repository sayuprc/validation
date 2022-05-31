<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\RequiredRule;
use Validation\Rules\RequiredWithoutRule;
use Validation\ValidateData;

class RequiredWithoutRuleTest extends TestCase
{
    private RequiredWithoutRule $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new RequiredWithoutRule(
            new RequiredRule(),
            new ValidateData([
                'name' => 'hoge',
                'age' => 23,
                'role' => 'human',
            ])
        );
    }

    /**
     * 他のカラムが1つでも存在しない場合、必須
     */
    public function testValidationSucceeded()
    {
        // nameをバリデーション
        $this->assertTrue($this->rule->validate('hoge', 'job'));

        $this->assertTrue($this->rule->validate('hoge', 'age,job'));
    }

    /**
     * 他のカラムがすべて存在している場合、必須ではない
     */
    public function testValidationSucceededWithNotExistsOthers()
    {
        // nameをバリデーション
        $this->assertTrue($this->rule->validate('hoge', 'age'));
        $this->assertTrue($this->rule->validate('hoge', 'age,role'));

        $this->assertTrue($this->rule->validate('', 'age'));
        $this->assertTrue($this->rule->validate('', 'age,role'));

        $this->assertTrue($this->rule->validate(null, 'age'));
        $this->assertTrue($this->rule->validate(null, 'age,role'));
    }

    /**
     * 他のカラムが1つでも存在せず、対象データがNULLの場合、検証失敗
     */
    public function testValidationFailedWithNull()
    {
        // nameをバリデーション
        $this->assertFalse($this->rule->validate(null, 'job'));
    }

    /**
     * 他のカラムが1つでも存在せず、対象データが空文字の場合、検証失敗
     */
    public function testValidationFailedWithEmpty()
    {
        // nameをバリデーション
        $this->assertFalse($this->rule->validate('', 'job'));
    }
}
