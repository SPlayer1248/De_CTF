<?php 
    include_once('server.php');
    
    if (!isset($_SESSION['username'])) {
      header('location: login.php');
    }
    
    if (isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['username']);
      unset($_SESSION['level']);

      if(isset($_COOKIE['flag'])){
        unset($_COOKIE['flag']);
        setcookie('flag', null, -1, '/');
        
      }
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
      <?php if(isset($_SESSION['level']) && $_SESSION['level']=='1'): ?>
        <a class="navbar-brand" href="detail.php">Manage</a>
      <?php endif ?>
      <a class="navbar-brand" style="padding-right: 50px" href="index.php?logout='1'" style="color: red;">Logout</a>
    <?php endif ?>
  </nav>
            </div>
     
            <div class="row">
                <div class=" col-md-1">
                    <h2 class="page-header">Users</h2>
                    <section class="comment-list">
                        <!-- First Comment -->
                        <?php if(!empty($contacts)): ?>
                        <?php foreach ($contacts as $contact): ?>
                        <article class="row">
                            <div class="col-md-12 col-sm-12 hidden-xs">
                                <figure class="thumbnail">
                                    <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                    <figcaption class="text-center"><a href="?user=<?php echo $contact ?>"><?php echo $contact ?></a></figcaption>
                                </figure>
                            </div>
                        </article>
                        <?php endforeach ?>
                        <?php endif ?>
                    </section>
                </div>
                <div class=" col-md-11">

                    <h2 class="page-header">Chitchat  <?php if(isset($_GET['user']) && !empty($_GET['user'])): ?> <button class="btn btn-success" onclick="showForm2()"><i class="fas fa-plus"></i></button><?php endif ?></h2>
                   
                           
                        
                    <section class="comment-list" style="margin-bottom: 20px;">
                        <?php if(isset($_GET['user']) && !empty($_GET['user'])): ?>
                        <article class="row">
                            <button class="btn btn-success" onclick="showForm1()">Send message</button>
                        </article>
                        <?php else: ?>
                        <article class="row">
                            <button class="btn btn-success" onclick="showForm2()">Send message</button>
                        </article>
                      <?php endif ?>
                    </section>
                    <section  class="comment-list row">
                    <div id="form1" class="comment-list" style="display: none;">
                        <form class="form-group" action="" method="post" accept-charset="utf-8">
                            <input name="receiver" value="<?php echo $_GET['user'] ?>" style="display: none;">
                            <label for="usr">Title:</label>
                            <input type="text" class="form-control" name="title">
                            <label for="comment">Content:</label>
                            <textarea class="form-control" rows="5" name="content"></textarea>
                            <?php include("errors.php") ?>
                            <input class="btn btn-success" type="submit" name="send_message" value="send">
                        </form>
                    </div>
                    <div id="form2" class="comment-list" style="display: none;">
                        <form class="form-group" action="" method="post" accept-charset="utf-8">
                            <label for="usr">To:</label>
                            <input type="text" class="form-control" name="receiver">
                            <label for="usr">Title:</label>
                            <input type="text" class="form-control" name="title">
                            <label for="comment">Content:</label>
                            <textarea class="form-control" rows="5" name="content"></textarea>
                            <?php include("errors.php") ?>
                            <input class="btn btn-success" type="submit" name="send_message" value="send">
                        </form>
                    </div>
                    <section class="comment-list">
                    <section class="comment-list">
                        <!-- First Comment -->
                        <?php if(!empty($received)): ?>
                        <?php foreach ($received as $msg): ?>
                        <?php if ($msg['receiver'] === $_SESSION['username']) :?>
                        <article class="row">
                            <div class="col-md-2 col-sm-2 hidden-xs">
                                <figure class="thumbnail">
                                    <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                    <figcaption class="text-center"><?php echo $msg['sender'] ?></figcaption>
                                </figure>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div class="panel panel-default arrow left">
                                    <div class="panel-body">
                                        <header class="text-left">
                                            <div class="comment-user"><i class="fa fa-user"></i><?php echo $msg['title'] ?></div>
                                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php echo $msg['date'] ?></time>
                                        </header>
                                        <div class="comment-post">
                                            <p>
                                                <?php echo $msg['content'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php else: ?>
                        <article class="row">
                            <div class="col-md-10 col-sm-10">
                                <div class="panel panel-default arrow right">
                                    <div class="panel-body">
                                        <header class="text-right">
                                            <div class="comment-user"><i class="fa fa-user"></i><?php echo $msg['title'] ?></div>
                                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php echo $msg['date'] ?></time>
                                        </header>
                                        <div class="comment-post">
                                            <p>
                                                <?php echo $msg['content'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 hidden-xs">
                                <figure class="thumbnail">
                                    <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                    <figcaption class="text-center"><?php echo $msg['sender'] ?></figcaption>
                                </figure>
                            </div>
                        </article>
                        <?php endif ?>
                        <?php endforeach ?>
                        <?php endif ?>
                    </section>
                </div>
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

