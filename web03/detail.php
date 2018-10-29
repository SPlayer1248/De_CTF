<?php include('server.php') ?>
<?php 
    if (!isset($_SESSION['level']) || $_SESSION['level'] != '1') {
        header('location: index.php');
    }
    
    if(!isset($_GET['mess_id']) && empty($_GET['mess_id'])){
        header('location: detail.php?mess_id=1');
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Manage messages</title>
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
            <?php if(isset($mess)): ?>
        <div class="row">
        <div class="col-sm-10 col-md-10">
            <div class="alert alert-success">
                <strong  class="close"><?php echo $mess['date'] ?></strong>
                <strong>From: <?php echo $mess['sender'] ?></strong>
                <hr class="message-inner-separator">
                <strong>To: <?php echo $mess['receiver'] ?></strong>
                <hr class="message-inner-separator">
                <strong>Title: <?php echo $mess['title'] ?></strong>
                <hr class="message-inner-separator">
                <p>
                    <?php echo $mess['content'] ?>
                </p>
            </div>
        </div>
        <form method="post" style=" border: none; background: transparent;">
            <input name="id" value="<?php echo $mess['id'] ?>" style='display: none;'>
            <input type="submit" name="del_mess" value="Delete">
        </form>
        <?php else: ?>
            <?php include('errors.php'); ?>
        <?php endif ?>

    </body>
</html>