<?php

declare(strict_types=1);

namespace Validation;

class ValidateData
{
    /**
     * @var array<string, mixed> $data
     */
    private array $data;

    /**
     * @param array<string, mixed> $data
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * 指定配列から値を取得する
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getValue(string $name): mixed
    {
        return array_key_exists($name, $this->data) ? $this->data[$name] : null;
    }

    /**
     * 配列にキーが存在するか
     *
     * @param string $name
     *
     * @return bool
     */
    public function exists(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * 指定したキーがすべて配列内に存在しているか
     *
     * @param array<string> $names
     *
     * @return bool
     */
    public function existsAll(array $names): bool
    {
        foreach ($names as $name) {
            if (! $this->exists($name)) {
                return false;
            }
        }

        return true;
    }

    /**
     * 指定したキーのいずれかが配列内に存在しているか
     *
     * @param array<string> $names
     *
     * @return bool
     */
    public function existsAny(array $names): bool
    {
        foreach ($names as $name) {
            if ($this->exists($name)) {
                return true;
            }
        }

        return false;
    }
}
