<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Validation\ValidateData;

class ValidateDataTest extends TestCase
{
    private ValidateData $data;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new ValidateData([
            'name' => 'hoge',
            'age' => 23,
            'role' => 'human',
        ]);
    }

    /**
     * @return void
     */
    public function testGetValue(): void
    {
        $expected = 'hoge';
        $actual = $this->data->getValue('name');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testGetNullValue(): void
    {
        $expected = null;
        $actual = $this->data->getValue('job');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testExists(): void
    {
        $this->assertTrue($this->data->exists('name'));
    }

    /**
     * @return void
     */
    public function testNotExists(): void
    {
        $this->assertFalse($this->data->exists('job'));
    }

    /**
     * @return void
     */
    public function testExistsAll(): void
    {
        $this->assertTrue($this->data->existsAll(['name', 'age']));
    }

    /**
     * @return void
     */
    public function testNotExistsAll(): void
    {
        $this->assertFalse($this->data->existsAll(['name', 'job']));
    }

    /**
     * @return void
     */
    public function testExistsAny(): void
    {
        $this->assertTrue($this->data->existsAny(['name', 'job']));
    }

    /**
     * @return void
     */
    public function testNotExistsAny(): void
    {
        $this->assertFalse($this->data->existsAny(['job', 'gender']));
    }
}
