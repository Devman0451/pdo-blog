<?php
    session_start();

    if (isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }

    include_once 'includes/header.php';

    if (isset($_GET['signup'])) {
        $error = $_GET['signup'];
        switch ($error) {
            case 'invalid':
                echo '<div class="msg-container"><p class="msg error-msg">Sign Up Failed: Make sure you\'re email is valid and password is at least 6 characters.</p></div>';
                break;
            case 'empty':
                echo '<div class="msg-container"><p class="msg error-msg">Sign Up Failed: Please fill in all fields.</p></div>';
                break;
            case 'usertaken':
                echo '<div class="msg-container"><p class="msg error-msg">Sign Up Failed: User name or email is already taken.</p></div>';
                break;
            default:
            echo '<div class="msg-container"><p class="msg error-msg">Error</p></div>';
        }
    }
?>

<section class="container signup">
    <form class="form-signup" action="includes/signup.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" class="btn btn-submit" value="Submit" name="submit">
    </form>
</section>