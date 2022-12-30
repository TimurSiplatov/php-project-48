<?php

namespace Phpunit\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class Test extends TestCase
{
  private $firstJsonFile;
  private $secondJsonFile;
  private $firstYmlFile;
  private $secondYmlFile;

  public function setUp(): void
  {
    $this->firstJsonFile = __DIR__ . "/fixtures/file1.json";
    $this->secondJsonFile = __DIR__ . "/fixtures/file2.json";
    $this->firstYmlFile = __DIR__ . "/fixtures/file1.yml";
    $this->secondYmlFile = __DIR__ . "/fixtures/file2.yml";
  }

  public function testMainGendiff(): void
  {
    $result = file_get_contents("tests/fixtures/stylishResult.txt");
    $this->assertEquals($result, genDiff($this->firstJsonFile, $this->secondJsonFile));
    $this->assertEquals($result, genDiff($this->firstYmlFile, $this->secondYmlFile));
  }

  public function testPlainFormat(): void
  {
    $result = file_get_contents("tests/fixtures/plainResult.txt");
    $this->assertEquals($result, genDiff($this->firstJsonFile, $this->secondJsonFile, "plain"));
    $this->assertEquals($result, genDiff($this->firstYmlFile, $this->secondYmlFile, "plain"));
  }

  public function testJsonFormat(): void
  {
    $result = file_get_contents("tests/fixtures/jsonResult.txt");
    $this->assertEquals($result, genDiff($this->firstJsonFile, $this->secondJsonFile, "json"));
    $this->assertEquals($result, genDiff($this->firstYmlFile, $this->secondYmlFile, "json"));
  }
}
