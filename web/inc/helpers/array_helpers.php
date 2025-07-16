<?php

function duplicateArrayPerCount(array $arr, int $count): array {
    $result = [];
    foreach ($arr as $v) for ($i = 0; $i < $count; $i++) $result[] = $v;
    return $result;
}
