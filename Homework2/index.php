<?php

$input = [];

while (count($input) < 2) {
    $line = fgets(STDIN);
    if ($line === false) break;
    $line = trim($line);
    if ($line !== '') {
        $input[] = $line;
    }
}

if (count($input) !== 2) {
    fwrite(STDERR, "Требуется указать два числа\n");
    exit(1); 
}

list($a_str, $b_str) = $input;

function is_integer_str($str) {
    return is_numeric($str) && (float)$str == (int)$str;
}

if (!is_integer_str($a_str) || !is_integer_str($b_str)) {
    fwrite(STDERR, "Введите, пожалуйста, число\n");
    exit(1);
}

$a = (int)$a_str;
$b = (int)$b_str;

if ($b === 0) {
    fwrite(STDERR, "Делить на 0 нельзя\n");
    exit(1);
}

$result = $a / $b;
echo "Решение: " . $result . PHP_EOL;
exit(0);