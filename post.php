<?php

    require('config/connect.php');

    if(isset($_POST['delete'])) {
        $delete_id = $_POST['delete_id'];

        $sql = 'DELETE FROM posts WHERE id = :id';
        $query = $pdo->prepare($sql);
        $query->execute(['id' => $delete_id]);

        header('Location: ' . ROOT_URL . "");
    }

    $id = $_GET['id'];

    $sql = 'SELECT * FROM posts WHERE id = :id';
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $id]);
    $post = $query->fetch();
?>

<?php include('includes/header.php')?>
    <div class="container">
            <div class="blog-post">
                <h1><?php echo $post['title']; ?></h1>
                <small>Posted on <?php echo $post['created_at']?> by <?php echo $post['author']; ?></small>
                <p><?php echo $post['body']; ?></p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="button-right" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                    <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                </form>
                <a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit Post</a>
                <a href="<?php echo ROOT_URL; ?>" class="btn btn-primary">Back</a>
            </div>
    </div> 
<?php include('includes/footer.php')?>