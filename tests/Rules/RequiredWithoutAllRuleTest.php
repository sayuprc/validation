<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\RequiredRule;
use Validation\Rules\RequiredWithoutAllRule;
use Validation\ValidateData;

class RequiredWithoutAllRuleTest extends TestCase
{
    private RequiredWithoutAllRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new RequiredWithoutAllRule(
            new RequiredRule(),
            new ValidateData([
                'name' => 'hoge',
                'age' => 23,
                'role' => 'human',
            ])
        );
    }

    /**
     * 他のカラムがすべて存在しない場合、必須
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        // nameをバリデーション
        $this->assertTrue($this->rule->validate('hoge', 'job'));

        $this->assertTrue($this->rule->validate('hoge', 'job,gender'));
    }

    /**
     * 他のカラムが一つでも存在している場合、必須ではない
     *
     * @return void
     */
    public function testValidationSucceededWithNotExistsOthers(): void
    {
        // nameをバリデーション
        $this->assertTrue($this->rule->validate('hoge', 'age,gender'));

        $this->assertTrue($this->rule->validate(null, 'age,gender'));

        $this->assertTrue($this->rule->validate('', 'age,gender'));
    }

    /**
     * 他のカラムがすべて存在せず、対象データがNULLの場合、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithNull(): void
    {
        // nameをバリデーション
        $this->assertFalse($this->rule->validate(null, 'job'));

        $this->assertFalse($this->rule->validate(null, 'job,gender'));
    }

    /**
     * 他のカラムがすべて存在せず、対象データが空文字の場合、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithEmpty(): void
    {
        // nameをバリデーション
        $this->assertFalse($this->rule->validate('', 'job'));

        $this->assertFalse($this->rule->validate('', 'job,gender'));
    }
}
