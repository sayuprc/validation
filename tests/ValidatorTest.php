<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Validation\Validator;

class ValidatorTest extends TestCase
{
    public function testValidateSucceeded()
    {
        $data = [
            'name' => 'hoge',
            'age' => 23,
            'role' => 'human',
            'job' => null,
        ];

        $rules = [
            'name' => ['required', 'string', 'minLength:1', 'maxLength:30'],
            'age' => ['numeric', 'min:0'],
            'job' => ['nullable', 'string'],
        ];

        $messages = [
            'name' => [
                'required' => '名前は必須です。',
                'string' => '名前は文字列で入力。',
                'miniLength' => '名前は1文字以上',
                'maxLength' => '名前は30文字以内',
            ],
            'age' => [
                'numeric' => '年齢は数値である必要があります。',
                'min' => '年齢は0以上',
            ],
            'job' => [
                'string' => '仕事は文字列',
            ],
        ];

        $validator = new Validator($data, $rules, $messages);

        $this->assertTrue($validator->validate(), implode('', $validator->errors()));
    }

    /**
     * 必須だが、値が存在しない
     */
    public function testValidateFailedRequiredWithNotExists()
    {
        $data = [];

        $rules = ['name' => ['required']];

        $messages = ['name' => ['required' => '名前は必須です。']];

        $validator = new Validator($data, $rules, $messages);

        $this->assertFalse($validator->validate());
    }

    /**
     * 文字列で値が存在しな => 検証しない
     * 最小最大も同様
     */
    public function testValidateSucceededStringWithNotExists()
    {
        $data = [];

        $rules = ['name' => ['string', 'minLength:1', 'maxLength:10', 'sameLength:5']];

        $messages = [
            'name' => [
                'string' => '名前は文字列。',
                'minLength' => '名前は1文字以上',
                'maxLength' => '名前は10文字以下',
                'sameLength' => '名前は5文字',
            ],
        ];

        $validator = new Validator($data, $rules, $messages);

        $this->assertTrue($validator->validate());
    }

    /**
     * 数値で値が存在しない => 検証しない
     * 最小最大も同様
     */
    public function testValidateSucceededNumericWithNotExists()
    {
        $data = [];

        $rules = ['age' => ['string', 'min:1', 'max:10', 'sameSize:5']];

        $messages = [
            'age' => [
                'numeric' => '年齢は数値',
                'min' => '年齢は1以上',
                'max' => '年齢は10以下',
                'sameSize' => '年齢は5',
            ],
        ];

        $validator = new Validator($data, $rules, $messages);

        $this->assertTrue($validator->validate());
    }

    /**
     * 配列で値が存在しない => 検証しない
     */
    public function testValidateSucceededArrayWithNotExists()
    {
        $data = [];

        $rules = ['items' => ['array']];

        $messages = ['items' => ['array' => 'アイテムは配列です。']];

        $validator = new Validator($data, $rules, $messages);

        $this->assertTrue($validator->validate());
    }

    /**
     * 正規表現ルールで値が存在しない => 検証しない
     * NotRegexも同様
     */
    public function testValidateSucceededRegexWithNotExists()
    {
        $data = [];

        $rules = ['postcode' => ['regex:/\A[0-9]{3}-[0-9]{4}\z/', 'notRegex:/[^0-9]/']];

        $messages = [
            'postcode' => [
                'regex' => '正しい形式ではありません。',
                'notRegex' => '正しい形式ではありません。',
            ],
        ];

        $validator = new Validator($data, $rules, $messages);

        $this->assertTrue($validator->validate());
    }
}
