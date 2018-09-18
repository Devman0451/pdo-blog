<?php

    require('config/connect.php');

    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }

    if(isset($_POST['submit'])){
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
        $author = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);  
    
        $sql = "INSERT INTO posts(title, author, body) VALUES (:title, :author, :body)";
        $query = $pdo->prepare($sql);
        $query->execute(['title' => $title, 'author' => $author, 'body' => $body]);
        
        header('Location: ' . ROOT_URL . "");
    }

?>

<?php include('includes/header.php')?>
    <div class="container">
        <h1>Add Post</h1>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-input" name="title" >
            </div>
            <!-- <div class="form-group">
                <label>Author</label>
                <input type="text" class="form-input" name="author" >
            </div> -->
            <div class="form-group">
                <label>Body</label>
                <input type="text" class="form-input" name="body" >
            </div>
            <input type="submit" class="btn btn-submit" value="Submit" name="submit">
            <a href="<?php echo ROOT_URL; ?>" class="btn btn-primary">Back</a>
        </form>
    </div> 
<?php include('includes/footer.php')?>