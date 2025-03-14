<?php
session_start(); // Запуск сессии

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяем, что поле 'username' не пустое
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        // Сохраняем имя пользователя в сессию
        $_SESSION['username'] = $_POST['username'];
    }
}

// Перенаправляем обратно на index.php
header('Location: index.php');
exit();
?>