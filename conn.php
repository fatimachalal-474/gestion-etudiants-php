<?php
include 'config.php';

$pdo = new PDO(
    "mysql:host=$host;dbname=$db",
    $user,
    $pass
);
?>