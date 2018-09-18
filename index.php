<?php

    require('config/connect.php');

    $sql = 'SELECT * FROM posts';
    $query = $pdo->prepare($sql);
    $query->execute();
    $posts = $query->fetchAll();

?>

<?php include('includes/header.php')?>
    <section class="container">
        <?php
            if (isset($_GET['signup'])) {
                $msg = $_GET['signup'];
                if ($msg == 'success') {
                    echo '<div class="msg-container"><p class="msg confirm-msg">You\'ve successfully signed up.</p></div>';
                }
            } else if (isset($_GET['login'])) {
                $msg = $_GET['login'];
                if ($msg == 'success') {
                    echo '<div class="msg-container"><p class="msg confirm-msg">You\'ve successfully logged in.</p></div>';
                } else if ($msg = 'error') {
                    echo '<div class="msg-container"><p class="msg error-msg">Error logging in.</p></div>';
                }
            }
            
        ?>
    <a href="<?php echo ROOT_URL?>addpost.php" class="btn btn-submit">Add New Post</a>
        <h1>Posts</h1>
        <?php foreach($posts as $post) : ?>
            <div class="blog-post">
                <h3><?php echo $post['title']; ?></h3>
                <small>Posted on <?php echo $post['created_at']?> by <?php echo $post['author']; ?></small>
                <p><?php echo $post['body']; ?></p>
                <a href="<?php echo ROOT_URL?>post.php?id=<?php echo $post['id'];?>" class="btn btn-primary">Read</a>
            </div>
        <?php endforeach; ?>
    </section> 
<?php include('includes/footer.php')?>