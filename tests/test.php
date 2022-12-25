<?php

namespace Phpunit\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class Test extends TestCase
{
  private $result1;
  private $result2;

  public function setUp(): void
  {
    $this->result1 = 
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
    $this->result2 =
"Property 'common.follow' was added with value: false
Property 'common.setting2' was removed
Property 'common.setting3' was updated. From true to null
Property 'common.setting4' was added with value: 'blah blah'
Property 'common.setting5' was added with value: [complex value]
Property 'common.setting6.doge.wow' was updated. From '' to 'so much'
Property 'common.setting6.ops' was added with value: 'vops'
Property 'group1.baz' was updated. From 'bas' to 'bars'
Property 'group1.nest' was updated. From [complex value] to 'str'
Property 'group2' was removed
Property 'group3' was added with value: [complex value]";
  }

    public function testMainJson()
    {
      $firstFile = __DIR__ . "/fixtures/file1.json";
      $secondFile = __DIR__ . "/fixtures/file2.json";
      $this->assertEquals($this->result1, genDiff($firstFile, $secondFile));
    }

    public function testMainYaml()
    {
      $firstFile = __DIR__ . "/fixtures/file1.yml";
      $secondFile = __DIR__ . "/fixtures/file2.yml";
      $this->assertEquals($this->result1, genDiff($firstFile, $secondFile));
    }

    public function testPlainFormat()
    {
      $firstFile = __DIR__ . "/fixtures/file1.yml";
      $secondFile = __DIR__ . "/fixtures/file2.yml";
      $this->assertEquals($this->result2, genDiff($firstFile, $secondFile, 'plain'));
    }
}
