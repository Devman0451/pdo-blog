<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<nav class="navbar">
    <p class="logo">BLOG</p>
    <ul class="navbar-list">
        <?php
            if (isset($_SESSION['username'])) {
                echo '
                    <li class="navbar-item"><a href="index.php">Home</a></li>
                    <li class="navbar-item">
                        <form action="includes/logout.php" method="POST">
                            <button class="btn btn-logout" type="submit" name="submit">Logout</button>
                        </form>
                    </li>
                ';
            } else {
                echo '
                    <li class="navbar-item"><a href="index.php">Home</a></li>
                    <li class="navbar-item"><a href="signup.php">Sign Up</a></li>
                    <li class="navbar-item"><a href="login.php">Sign In</a></li>
                ';
            }
        ?>
    </ul>
</nav>