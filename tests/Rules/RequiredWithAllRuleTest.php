<?php

declare(strict_types=1);

namespace Tests\Rules;

use PHPUnit\Framework\TestCase;
use Validation\Rules\RequiredRule;
use Validation\Rules\RequiredWithAllRule;
use Validation\ValidateData;

class RequiredWithAllRuleTest extends TestCase
{
    private RequiredWithAllRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new RequiredWithAllRule(
            new RequiredRule(),
            new ValidateData([
                'name' => 'hoge',
                'age' => 23,
                'role' => 'human',
            ])
        );
    }

    /**
     * 他のカラムがすべて存在する場合、必須となる
     *
     * @return void
     */
    public function testValidationSucceeded(): void
    {
        // nameをバリデーション
        $this->assertTrue($this->rule->validate('hoge', 'age'));

        $this->assertTrue($this->rule->validate('hoge', 'age,role'));

        // $this->assertTrue($this->rule->validate('', 'age'));

        // $this->assertTrue($this->rule->validate('', 'age,role'));

        // $this->assertTrue($this->rule->validate(null, 'age'));

        // $this->assertTrue($this->rule->validate(null, 'age,role'));
    }

    /**
     * 他のカラムがひとつでも存在しない場合、必須ではない
     *
     * @return void
     */
    public function testValidationSucceededWithNotExistsOthers(): void
    {
        // nameをバリデーション
        $this->assertTrue($this->rule->validate('hoge', 'job'));
        $this->assertTrue($this->rule->validate('hoge', 'age,job'));

        $this->assertTrue($this->rule->validate(null, 'job'));
        $this->assertTrue($this->rule->validate(null, 'age,job'));

        $this->assertTrue($this->rule->validate('', 'job'));
        $this->assertTrue($this->rule->validate('', 'age,job'));
    }

    /**
     * 他のカラムがすべて存在し、対象データがNULLの場合、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithNull(): void
    {
        // nameをバリデーション
        $this->assertFalse($this->rule->validate(null, 'age'));

        $this->assertFalse($this->rule->validate(null, 'age,role'));
    }

    /**
     * 他のカラムがすべて存在し、対象データが空文字の場合、検証失敗
     *
     * @return void
     */
    public function testValidationFailedWithEmpty(): void
    {
        // nameをバリデーション
        $this->assertFalse($this->rule->validate('', 'age'));

        $this->assertFalse($this->rule->validate('', 'age,role'));
    }
}
