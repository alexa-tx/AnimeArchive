<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_database = 'AnimeArchive'; 
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_database);

if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
mysqli_select_db($link, $db_database);
?>
