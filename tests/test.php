<?php

namespace Phpunit\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class Test extends TestCase
{
  private $result;

  public function setUp(): void
  {
    $this->result = 
"{
    common: {
      + follow: false
        setting1: Value 1
      - setting2: 200
      - setting3: true
      + setting3: null
      + setting4: blah blah
      + setting5: {
            key5: value5
        }
        setting6: {
            doge: {
              - wow: 
              + wow: so much
            }
            key: value
          + ops: vops
        }
    }
    group1: {
      - baz: bas
      + baz: bars
        foo: bar
      - nest: {
            key: value
        }
      + nest: str
    }
  - group2: {
        abc: 12345
        deep: {
            id: 45
        }
    }
  + group3: {
        deep: {
            id: {
                number: 45
            }
        }
        fee: 100500
    }
}";
  }
    public function testMainJson()
    {
      $firstFile = __DIR__ . "/fixtures/file1.json";
      $secondFile = __DIR__ . "/fixtures/file2.json";
      $this->assertEquals($this->result, genDiff($firstFile, $secondFile));
    }

    public function testMainYaml()
    {
      $firstFile = __DIR__ . "/fixtures/file1.yml";
      $secondFile = __DIR__ . "/fixtures/file2.yml";
      $this->assertEquals($this->result, genDiff($firstFile, $secondFile));
    }
}
