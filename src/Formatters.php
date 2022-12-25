<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\stylishFormat;
use function Differ\Formatters\Plain\plainFormat;

function format($tree, $format)
{
    switch ($format) {
        case 'stylish':
            return stylishFormat($tree);
        case 'plain':
            return plainFormat($tree);
    }
}
