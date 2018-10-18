<?php 
  include_once('server.php');

  if (!isset($_SESSION['username'])) {
    header('location: login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <title>Pet worlds</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!-- <div> -->
  <nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" style="color: white;padding-left: 40px" href="#">Pet world</a>
  <a class="navbar-link"  href="?page=home">Home</a>
    <a class="navbar-link" href="?page=upload">Upload</a>
    <a class="navbar-link" href="?page=profile">Profile</a>
    <?php  if (isset($_SESSION['username'])) : ?>
      <strong><?php echo $_SESSION['username']; ?></strong>
      <a class="navbar-brand" style="color: white;padding-right: 50px" href="index.php?logout='1'" style="color: red;">Logout</a>
    <?php endif ?>
  </nav>
 
<!-- </div> -->


<div>
    <?php if (isset($_GET['page']) && !empty($_GET['page'])) {
              include($_GET['page'].'.php');
    } else {
        header('location: ?page=home');
      }
     ?>
    

</div>
    
</body>
</html>