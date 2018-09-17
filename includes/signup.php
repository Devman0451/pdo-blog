<?php

    if (isset($_POST['submit'])) {
        include_once '../config/connect.php';

        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $pwd = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username) || empty($email) || empty($pwd)) {
            header("Location: ../signup.php?signup=empty");
            exit();
        } else {
            if (!preg_match("/^[a-zA-Z0-9]*$/", $username) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pwd) < 6) {
                header("Location: ../signup.php?signup=invalid");
                exit();
            } else {
                $sql = "SELECT * FROM users WHERE username=?";
                $query = $pdo->prepare($sql);
                $query->execute([$username]);
                
                if($query->rowCount()) {
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                } else {
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users(username, email, password) VALUES (:username, :email, :pwd)";
                    $query = $pdo->prepare($sql);
                    $query->execute(['username' => $username, 'email' => $email, 'pwd' => $hashedPwd]);
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }

    } else {
        header("Location: ../signup.php");
        exit();
    }