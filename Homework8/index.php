<?

session_start();
header('Content-Type: text/html; charset=utf-8');

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    echo "<h1>Привет, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
    echo "<p><a href='exit.php'>Выйти</a></p>";
} else {
    include_once('./form.php');
}
