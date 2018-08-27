<?php

    require('config/connect.php');

    $sql = 'SELECT * FROM posts';
    $query = $pdo->prepare($sql);
    $query->execute();
    $posts = $query->fetchAll();
?>

<?php include('includes/header.php')?>
    <div class="container">
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
    </div> 
<?php include('includes/footer.php')?>