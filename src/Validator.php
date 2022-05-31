<?php

namespace Validation;

use Validation\Rules\NotExistsRuleException;
use Validation\Rules\RuleInterface;

class Validator
{
    private ValidateData $data;

    private array $rules;

    private array $messages;

    private array $errors;

    /**
     * @var array<string, RuleInterface> $cache
     */
    private array $cache;

    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     *
     * @return void
     */
    public function __construct(array $data = [], array $rules = [], array $messages = [])
    {
        $this->data = new ValidateData($data);
        $this->rules = $rules;

        $this->setMessages($messages);

        $this->errors = [];
        $this->cache = [];
    }

    /**
     * エラー表示に利用するメッセージの組み立て
     *
     * @param array $messages
     *
     * @return void
     */
    private function setMessages(array $messages): void
    {
        $this->messages = [];

        foreach ($messages as $k => $rules) {
            foreach ($rules as $rule => $message) {
                $this->messages[$k][$this->ucfirst($rule)] = $message;
            }
        }
    }

    /**
     * 文字列の先頭を大文字にする
     *
     * @param string $value
     *
     * @return string
     */
    private function ucfirst(string $value): string
    {
        return ucfirst(strtolower($value));
    }

    /**
     * 検証実行
     *
     * @return bool
     */
    public function validate(): bool
    {
        $this->errors = [];

        foreach ($this->rules as $name => $rules) {
            foreach ($rules as $rule) {
                [$rule, $parameters] = $this->parseRule($rule);

                $value = $this->data->getValue($name);

                $shouldValidate = $this->shouldValidate($name, $value);

                if ($this->isDependent($name)) {
                    // 依存系のみ、コンストラクタが違うのでどうにかしたい
                    $ruleVerifier = $this->makeRequired($rule);
                } else {
                    $ruleVerifier = $this->makeRule($rule);
                }

                if ($shouldValidate && ! $ruleVerifier->validate($value, $parameters, $this->data)) {
                    $this->addErrors($name, $rule);
                }
            }
        }

        return count($this->errors) === 0;
    }

    /**
     * ルールの文字列からルールとパラメータを分ける
     *
     * @param string $rule
     *
     * @return array<string, string>
     */
    private function parseRule(string $rule): array
    {
        $parameters = '';

        if (str_contains($rule, ':')) {
            [$rule,$parameters] = explode(':', $rule, 2);
        }

        $rule = $this->ucfirst($rule);

        return [$rule, $parameters];
    }

    /**
     * ルールクラスを生成する
     *
     * @param string $rule
     *
     * @throws NotExistsRuleException
     *
     * @return RuleInterface
     */
    private function makeRule(string $rule): RuleInterface
    {
        $className = sprintf("\Validation\Rules\%sRule", $rule);

        if (! class_exists($className)) {
            throw new NotExistsRuleException(sprintf('Rule does not exists. [%s]', $className));
        }

        $instance = $this->getCache($className);

        if ($instance === null) {
            $instance = new $className();
            $this->cache[$className] = $instance;
        }

        return $instance;
    }

    /**
     * キャッシュからルールクラスを取得する
     *
     * @param string $rule
     *
     * @return RuleInterface|null
     */
    private function getCache(string $rule): RuleInterface|null
    {
        return $this->cache[$rule] ?? null;
    }

    /**
     * Required系ルールクラスを生成する
     *
     * @param string $rule
     *
     * @throws NotExistsRuleException
     *
     * @return RuleInterface
     */
    private function makeRequired(string $rule): RuleInterface
    {
        $className = sprintf("\Validation\Rules\%sRule", $rule);

        if (! class_exists($className)) {
            throw new NotExistsRuleException(sprintf('Rule does not exists. [%s]', $className));
        }

        $instance = $this->getCache($className);

        if ($instance === null) {
            $requiredRule = $this->makeRule('Required');
            $instance = new $className($requiredRule, $this->data);
            $this->cache[$className] = $instance;
        }

        return $instance;
    }

    /**
     * 検証するかを判別する
     *
     * 下記の場合、検証する
     *
     * - Nullableルールが指定してあり、値がNULL
     * - データが存在しない(array_key_exists()がfalse)
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return bool
     */
    private function shouldValidate(string $name, mixed $value): bool
    {
        // Nullableかつ値がNULL => 検証しない
        if ($this->hasRule($name, 'nullable') && $value === null) {
            return false;
        }

        // 必須系のルールがある => 検証する
        if ($this->hasRule($name, 'required')) {
            return true;
        }

        // データが存在する => 検証する
        return $this->data->exists($name);
    }

    /**
     * ルールの指定があるか
     *
     * @param string $name
     * @param string $rules
     *
     * @return bool
     */
    private function hasRule(string $name, string $rule): bool
    {
        return in_array($rule, $this->rules[$name] ?? []);
    }

    /**
     * 指定ルールが一つでもあるかどうか
     *
     * @param string $name
     * @param array  $rules
     *
     * @return bool
     */
    private function hasAnyRules(string $name, array $rules): bool
    {
        foreach ($rules as $rule) {
            if ($this->hasRule($name, $rule)) {
                return true;
            }
        }

        return false;
    }

    /**
     * 他カラムに依存するルールを使っているか
     *
     * @param string $name
     * @param string $rule
     *
     * @return bool
     */
    private function isDependent(string $name): bool
    {
        return $this->hasAnyRules(
            $name,
            ['requiredWith', 'requiredWithAll', 'requiredWithout', 'requiredWithoutAll']
        );
    }

    /**
     * エラーメッセージを追加する
     *
     * @param string $name
     * @param string $rule
     *
     * @return void
     */
    private function addErrors(string $name, string $rule): void
    {
        $message = $this->messages[$name][$rule] ?? '';

        $this->errors[] = $message;
    }

    /**
     * 検証エラーメッセージ
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }
}
