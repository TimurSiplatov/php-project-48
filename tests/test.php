<?php

namespace Phpunit\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class Test extends TestCase
{
    public function testMainJson()
    {
        $firstFile = __DIR__ . "/fixtures/file1.json";
        $secondFile = __DIR__ . "/fixtures/file2.json";
        $expected =
"{
- follow: false
  host: hexlet.io
- proxy: 123.234.53.22
- timeout: 50
+ timeout: 20
+ verbose: true
}";
        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }
}