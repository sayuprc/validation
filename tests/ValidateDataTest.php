<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Validation\ValidateData;

class ValidateDataTest extends TestCase
{
    private ValidateData $data;

    public function setUp(): void
    {
        $this->data = new ValidateData([
            'name' => 'hoge',
            'age' => 23,
            'role' => 'human',
        ]);
    }

    public function testGetValue()
    {
        $expected = 'hoge';
        $actual = $this->data->getValue('name');

        $this->assertEquals($expected, $actual);
    }

    public function testGetNullValue()
    {
        $expected = null;
        $actual = $this->data->getValue('job');

        $this->assertEquals($expected, $actual);
    }

    public function testExists()
    {
        $this->assertTrue($this->data->exists('name'));
    }

    public function testNotExists()
    {
        $this->assertFalse($this->data->exists('job'));
    }

    public function testExistsAll()
    {
        $this->assertTrue($this->data->existsAll(['name', 'age']));
    }

    public function testNotExistsAll()
    {
        $this->assertFalse($this->data->existsAll(['name', 'job']));
    }

    public function testExistsAny()
    {
        $this->assertTrue($this->data->existsAny(['name', 'job']));
    }

    public function testNotExistsAny()
    {
        $this->assertFalse($this->data->existsAny(['job', 'gender']));
    }
}
