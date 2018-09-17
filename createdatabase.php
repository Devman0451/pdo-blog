<?php

$host = "localhost";
$root = "root";
$root_password = "";
$user = 'user';
$pass = '';
$db = "blogdb";
$table = "posts";

try {
    $pdo = new PDO("mysql:host=$host", $root, $root_password);

    $pdo->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;");

    $pdo->exec("use blogdb");

    $sql = "CREATE TABLE IF NOT EXISTS posts( `id` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `body` TEXT NOT NULL , `author` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    $pdo->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS users( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(25) NOT NULL , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    $pdo->exec($sql);

} catch (PDOException $exc) {
    die("DB ERROR: " . $exc->getMessage());
}

