<?php
session_start(); // Запуск сессии

// Очищаем переменную сессии
unset($_SESSION['username']);

// Перенаправляем обратно на index.php
header('Location: index.php');
exit();
?>