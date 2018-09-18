<?php

    require('config/connect.php');

    if(isset($_POST['submit'])){
        $update_id = filter_var($_POST['update_id'], FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS); 
    
        $sql = "UPDATE posts SET title = :title, body = :body WHERE id = :update_id";
        $query = $pdo->prepare($sql);
        $query->execute(['title' => $title, 'body' => $body, 'update_id' => $update_id]);

        header('Location: ' . ROOT_URL . "");
    }

    $id = $_GET['id'];

    $sql = 'SELECT * FROM posts WHERE id = :id';
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $id]);
    $post = $query->fetch();
?>

<?php include('includes/header.php')?>
    <section class="container">
        <h1>Edit Post</h1>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-input" name="title" value="<?php echo $post['title']; ?>" >
            </div>
            <div class="form-group">
                <label>Body</label>
                <input type="text" class="form-input" name="body" value="<?php echo $post['body']; ?>" >
            </div>
            <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
            <input type="submit" class="btn btn-submit" value="Submit" name="submit">
            <a href="<?php echo ROOT_URL; ?>" class="btn btn-primary">Back</a>
        </form>
    </section> 
<?php include('includes/footer.php')?>