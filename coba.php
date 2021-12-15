<?php

function getManyArgs(?string ...$arguments)
{
    var_dump(join(',', $arguments) === "");
}

function nullCheck(?string $arg)
{
    $str = $arg ?? 'null data';
    var_dump($str);
}

nullCheck('not null');

$arr = ["key" => "value", "key1" => "value1"];

foreach ($arr as $key => $value) {
    var_dump($key);
    echo "=============";
    var_dump($value);
}

// getManyArgs();
