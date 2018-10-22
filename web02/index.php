<?php 
    include_once('server.php');
    
    if (!isset($_SESSION['username'])) {
      header('location: login.php');
    }
    
    if (isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['username']);
      unset($_SESSION['level']);
    
      header("location: login.php");
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chitchat</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
        <div class="row">
            <nav class="navbar navbar-dark bg-dark">
                <?php  if (isset($_SESSION['username'])) : ?>
                <a class="navbar-brand" href="#"><strong><?php echo $_SESSION['username']; ?></strong></a>
                <a class="navbar-brand" href="post_add.php">Write post</a>
                <?php if(isset($_SESSION['level']) && $_SESSION['level']=='1'): ?>
                <a class="navbar-brand" href="admin.php">Admin</a>
                <?php endif ?>
                <a class="navbar-brand" style="padding-right: 50px" href="index.php?logout='1'" style="color: red;">Logout</a>
                <?php endif ?>
            </nav>
        </div>
        <div class="row">
            <div class=" col-md-12">
                <h2 class="page-header">Posts</h2>
                <section class="comment-list">
                    <!-- First Comment -->
                    <?php if(!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                    <article class="row">
                        <div class="col-md-12 col-sm-12 hidden-xs">
                            <p><?php echo $post['title'] ?></p>
                            <p><?php echo $post['content'] ?></p>
                            <p><?php echo $post['author'] ?></p>
                            <p><?php echo $post['date_created'] ?></p>
                            <?php if ($_SESSION['username'] === $post['author'] || $_SESSION['level'] == '1' ): ?>
                            <form method="post">
                                <input name="id" type="hidden" value="<?php echo($post['id']) ?>">
                                <input type="submit" name="del_post" value="Delete"> 
                            </form>
                            <a href="post_edit.php?id=<?php echo $post['id'] ?>&action=edit">Edit</a>
                            <?php endif ?>
                            <br><br>
                        </div>
                    </article>
                    <?php endforeach ?>
                    <?php endif ?>
                </section>
            </div>
        </div>
        <script>
            function showForm1() {
            var x = document.getElementById("form1");
            if (x.style.display === "none") {
            x.style.display = "block";
            } else {
            x.style.display = "none";
            }
            } 
        </script>
        <script>
            function showForm2() {
            var x = document.getElementById("form2");
            if (x.style.display === "none") {
            x.style.display = "block";
            } else {
            x.style.display = "none";
            }
            } 
        </script>
    </body>
</html>