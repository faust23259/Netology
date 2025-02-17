<?php
echo "Название файла: " . __FILE__ . "<br>" . "Текущая строка: " . __LINE__ . '<br>';

$multiLineString = <<<EOD
Это многострочный текст,
использующий синтаксис heredoc.
Она может содержать любые символы,
включая "кавычки" и 'апострофы'.
EOD;

echo $multiLineString . '<br>';

$a = 'Рыба';
$b = 'человек';

echo "$a рыбою сыта, а $b человеком" . '<br>';

/* Вариант c elseif */

$variable = 3.14;
// $variable = 3;
// $variable = 'one';
// $variable = true;
// $variable = null;
// $variable = [];

$type;

if (is_bool($variable)) {
    $type = 'bool';
} elseif (is_float($variable)) {
    $type = 'float';
} elseif (is_int($variable)) {
    $type = 'int';
} elseif (is_string($variable)) {
    $type = 'string';
} elseif (is_null($variable)) {
    $type = 'null';
} else {
    $type = 'other';
};

echo "type is $type" . "<br>";

/* Вариант со switch */

$variable = 'fferfer';

switch (true) {
    case is_bool($variable):
        $type = 'bool';
        break;
    case is_float($variable):
        $type = 'float';
        break;    
    case is_int($variable):
        $type = 'int';
        break;
    case is_string($variable):
        $type = 'string';
        break;
    case is_null($variable):
        $type = 'null';
        break;    
    default:
        $type = 'other';
};

echo "type is $type";

