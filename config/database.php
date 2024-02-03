<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    if (strpos($_SERVER['REQUEST_URI'], 'item') !== false) {
        header("Location:/Projet_php/src/user/login.php");
        exit();
    }
}

require_once (__DIR__ . '/global.php');

$dbName = DB_NAME;
$dbHost = DB_HOST;

$dsn = "mysql:host=$dbHost;port=3306;dbname=$dbName";

$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);