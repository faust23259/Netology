<?php

$name = 'иван';
$secondName = 'иванов';
$lastName = 'иванович';

$inputData = $name . ' ' . $secondName . ' ' . $lastName;
$fullNameData = $secondName . ' ' . $name . ' ' . $lastName;
$fullName = mb_convert_case($fullNameData, MB_CASE_TITLE, "UTF-8");
$arName = explode(" ", mb_convert_case($inputData, MB_CASE_TITLE, "UTF-8"));
$surnameAndInitials = $arName[1] . " " . mb_substr($arName[0], 0, 1) . "." .  mb_substr($arName[2], 0, 1) . ".";
$fio = "";

foreach ($arName as $word) {
    $fio .= mb_substr($word, 0, 1);
}

echo 'Полное имя: ' . "'" . $fullName . "'" . "\r\n";
echo 'Фамилия и инициалы: ' . "'" . $surnameAndInitials . "'" . "\r\n";
echo 'Аббревиатура: ' . "'" . $fio . "'" . "\r\n";
