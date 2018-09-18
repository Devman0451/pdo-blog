<?php

session_start();

if (isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['submit'])) {

    include_once '../config/connect.php';

    $uid = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($uid) || empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username = :uid OR email = :uid";
        $query = $pdo->prepare($sql);
        $query->execute(['uid' => $uid]);

        if ($query->rowCount() < 1) {
            header('Location: ../index.php?login=error');
            exit();
        } else {
            if ($row = $query->fetch()) {
                $pwdValidate = password_verify($pwd, $row['password']);
                if ($pwdValidate == false) {
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif ($pwdValidate == true) {
                   $_SESSION['username'] = $row['username'];
                   $_SESSION['id'] = $row['id']; 
                   header('Location: ../index.php?login=success');
                   exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php?login=error");
    exit();
}