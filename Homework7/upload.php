<?php

if(empty($_POST['file_name'])) {
    header('Location: index.php');
    exit();
}

if(!isset($_FILES['content']) || $_FILES['content']['error'] !== UPLOAD_ERR_OK) {
    header('Location: index.php');
    exit();
}

$fileName = $_POST['file_name'];
$tmpFilePath = $_FILES['content']['tmp_name'];
$uploadDir = 'upload/';

if(!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$destinationPath = $uploadDir . $fileName;

if(move_uploaded_file($tmpFilePath, $destinationPath)) {
    echo "Файл успешно загружен.<br>";
    echo "Полный путь к файлу: " . realpath($destinationPath) . "<br>";
    echo "Размер файла: " . filesize($destinationPath) . "<br>";
} else {
    echo "Ошибка загрузки файла.";
}