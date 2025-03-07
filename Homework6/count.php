<?php
session_start();

echo "<h1>Количество открытий страницы</h1>";

if (isset($_SESSION['count'])) {
    echo "<p>Страница 'session_start.php' была открыта " . $_SESSION['count'] . " раз.</p>";
} else {
    echo "<p>Страница еще не была открыта.</p>";
}
?>