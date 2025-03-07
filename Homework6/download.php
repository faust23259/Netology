<?php
if (isset($_GET['text'])) {
    $text = $_GET['text'];
    $filename = "download.txt";
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $text;
} else {
    echo "Необходимо передать параметр text в URL.";
}
?>