<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\RequiredRule;
use Validation\Rules\RequiredWithRule;
use Validation\ValidateData;

class RequiredWithRuleTest extends TestCase
{
    private RequiredWithRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new RequiredWithRule(
            new RequiredRule(),
            new ValidateData([
                'name' => 'hoge',
                'age' => 23,
                'role' => 'human',
            ])
        );
    }

    /**
     * 他のカラムが1つでも存在する場合、必須
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        // nameをバリデーション
        $this->assertTrue($this->rule->validate('hoge', 'age'));

        $this->assertTrue($this->rule->validate('hoge', 'age,role'));

        $this->assertTrue($this->rule->validate('hoge', 'age,job'));
    }

    /**
     * 他のカラムが一つも存在しない場合、検証成功
     *
     * @return void
     */
    public function testValidationSucceededWithNotExistsOthers(): void
    {
        // nameをバリデーション
        $this->assertTrue($this->rule->validate('hoge', 'gender'));

        // 他のカラムが存在していなければ対象の値は何でもよい
        $this->assertTrue($this->rule->validate(null, 'gender'));
    }

    /**
     * 他のカラムが1つでも存在し、対象データがNULLの場合、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithNull(): void
    {
        // nameをバリデーション
        $this->assertFalse($this->rule->validate(null, 'age'));
    }

    /**
     * 他のカラムが1つでも存在し、対象データが空文字の場合、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithEmpty(): void
    {
        // nameをバリデーション
        $this->assertFalse($this->rule->validate('', 'age'));
    }
}
