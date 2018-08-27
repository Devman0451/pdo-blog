<?php

    define('ROOT_URL', 'http://localhost/pdoblog/');
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'blogdb');

    $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME;

    try {
        $pdo = new PDO($dsn, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }