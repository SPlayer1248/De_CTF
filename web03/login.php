<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Pet worlds</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    body{
      background-image: url('http://wpnature.com/wp-content/uploads/2016/08/lakes-sunset-purple-lake-clouds-sky-autumn-desktop-1366x768.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }
    
  </style>
</head>
<body>
  <div class="container-fluid" style="padding-top: 20px">
    <div class="row">
      <div class="col-md-4 offset-md-4" style="padding-top: 48px">  
        <form method="post" action="login.php">
       <?php include('errors.php'); ?>
       <div >
        <label ><strong>Username</strong></label>
        <input type="text" class="form-control" name="username" placeholder="Enter Username" >
       </div>
       <div>
      <label><strong>Password</strong></label>
      <input type="password" name="password" placeholder="Enter Username" class="form-control">
    </div>
    <div style="padding-top: 15px">
      <button id="login_btn" type="submit" class="btn btn-success" name="login_user">Login</button>
    </div>
    <div style="padding-top: 20px">
       <p> Not yet a member? <a href="register.php">Sign up</a> </p>
    </div>

  </form>
</div>
</div>
</div>
</body>
</html>