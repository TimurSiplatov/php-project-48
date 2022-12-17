<?php

namespace Differ\Differ;

use function Differ\Parsers\parseFile;

function genDiff(string $firstPath, string $secondPath, string $format = 'stylish')
{
    $firstFile = parseFile($firstPath);
    $secondFile = parseFile($secondPath);
    ksort($firstFile);
    ksort($secondFile);
    $uniqKeysFromFirstFile = array_diff_key($firstFile, $secondFile);
    $uniqKeysFromSecondFile = array_diff_key($secondFile, $firstFile);
    $equalsKeys = array_intersect_assoc($firstFile, $secondFile);

    $result = [];

    foreach ($firstFile as $key => $value) {
        if (is_bool($value)) {
            $value = $value ? "true" : "false";
        }
        if (array_key_exists($key, $uniqKeysFromFirstFile)) {
            $result[] = "- {$key}: {$value}";
        } elseif (array_key_exists($key, $equalsKeys)) {
            $result[] = "  {$key}: {$value}";
        } elseif ($firstFile[$key] !== $secondFile[$key]) {
            $result[] = "- {$key}: {$value}";
            $result[] = "+ {$key}: {$secondFile[$key]}";
        }
    }

    foreach ($secondFile as $key => $value) {
        if (is_bool($value)) {
            $value = $value ? "true" : "false";
        }
        if (array_key_exists($key, $uniqKeysFromSecondFile)) {
            $result[] = "+ {$key}: {$value}";
        }
    }

    $result = array_unique($result);
    $result = implode("\n", $result);
    return ("{\n{$result}\n}");
}
