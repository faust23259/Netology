<?php

ini_set('default_charset','UTF-8');
mb_internal_encoding('UTF-8'); 

$name = readline("Введите имя: ");
$secondName = readline("Введите фамилию: ");
$lastName = readline("Введите отчество: ");

//echo "Отладка: Имя='$name', Фамилия='$secondName', Отчество='$lastName'\n";

if (empty($name) || empty($secondName) || empty($lastName)) {
    fwrite(STDERR, "Ошибка: Все поля должны быть заполнены!\n");
    exit(1);
}

$inputData = $name . ' ' . $secondName . ' ' . $lastName;
echo "Введенные данные: " . $inputData . "\n";

$fullNameData = $secondName . ' ' . $name . ' ' . $lastName;
$fullName = mb_convert_case($fullNameData, MB_CASE_TITLE, "UTF-8");

$arName = explode(" ", $fullName);

$surnameAndInitials = $arName[0] . " " . mb_substr($arName[1], 0, 1) . "." . mb_substr($arName[2], 0, 1) . ".";
$fio = "";

foreach ($arName as $word) {
    $fio .= mb_substr($word, 0, 1);
}

echo 'Полное имя: ' . "'" . $fullName . "'" . "\n";
echo 'Фамилия и инициалы: ' . "'" . $surnameAndInitials . "'" . "\n";
echo 'Аббревиатура: ' . "'" . $fio . "'" . "\n";