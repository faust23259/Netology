<?php
session_start();

if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
}

$_SESSION['count']++;

if ($_SESSION['count'] % 3 === 0) {
    header("Location: count.php");
    exit();
}

echo "<h1>Страница сессии</h1>";
echo "<p>Эта страница открыта " . $_SESSION['count'] . " раз.</p>";
?>