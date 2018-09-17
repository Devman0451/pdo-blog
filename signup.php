<?php
    include_once 'includes/header.php';
?>

<section class="container signup">
    <form class="form-signup" action="includes/signup.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" class="btn btn-submit" value="Submit" name="submit">
    </form>
</section>