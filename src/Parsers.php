<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;
use Exception;

function parseFile($pathToFile)
{
    $fileFormat = pathinfo($pathToFile, PATHINFO_EXTENSION);
    if (filesize($pathToFile) === 0) {
        throw new Exception('Error, empty file');
    }
    if ($fileFormat === "json") {
        return json_decode(file_get_contents($pathToFile), FILE_USE_INCLUDE_PATH);
    } elseif ($fileFormat === "yaml" || $fileFormat === "yml") {
        return Yaml::parseFile($pathToFile);
    } else {
        throw new Exception("Error, unknown extension");
    }
}
