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
    }
  </style>
</head>
<body>
  <div class="container-fluid" style="padding-top: 20px">
    <div class="row">
      <div class="col-md-4 offset-md-4" style="padding-top: 48px">  
        <form method="post" action="register.php">
          <h2 align="center" id = "register">Register</h2>
          <div>
            <?php include('errors.php'); ?>
            <label ><strong>Username</strong></label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?php echo $username; ?>">
            <div>
              <label><strong>Password</strong></label>
              <input type="password" name="password_1" class="form-control" placeholder="Enter Password">
            </div>
            <div style="padding-top: 5px">
              <label><strong>Confirm password</strong></label>
              <input type="password" name="password_2" class="form-control" placeholder="Enter Password">
            </div>
             <div style="padding-top: 20px">
                 <p> Already have account? <a href="login.php">Log in</a> </p>
              </div>
            <div style="padding-top: 15px">
              <button id="reg_btn" type="submit" class="btn btn-success" name="reg_user">Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>