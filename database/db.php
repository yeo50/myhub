<?php
require("./database/config.php");
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8mb4";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // if ($pdo) {
    //     echo "db connected";
    // }
} catch (PDOException $e) {
    die($e->getMessage());
}
