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
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div>
  <h2>Home Page</h2>
  <ul>
    <li><a href="?page=home">Home</a></li>
    <li><a href="?page=upload">Upload</a></li>
    <li><a href="?page=profile">Profile</a></li>
    <?php  if (isset($_SESSION['username'])) : ?>
      <li><strong><?php echo $_SESSION['username']; ?></strong></li>
      <li> <a href="index.php?logout='1'" style="color: red;">Logout</a> </li>
    <?php endif ?>
  </ul>
</div>


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