<?php
session_start();
define('DBUSER', 'root');
define('DBPWD', '');
define('DBHOST', 'localhost');
define('DBNAME', 'ctf_web01');
$db       = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
$username = "";
$errors   = array();
// $check = "True";

// var_dump($_SESSION);
// die();
if (isset($_POST['reg_user'])) {
    $username   = mysqli_real_escape_string($db, $_POST['username']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    $user_check_query = "SELECT * FROM users WHERE username='$username'";
    $result           = mysqli_query($db, $user_check_query);
    $user             = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
    }
    if (count($errors) == 0) {
        $query = "INSERT INTO users (username,password) VALUES('$username','$password_1')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        header('location: index.php');
    }
}
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        $query   = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}


if (isset($_POST['upload'])) {
    if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['age']) && !empty($_POST['age'])) {
        $name       = $_POST['name'];
        $age        = $_POST['age'];
        $uploadOk   = 1;
        $username   = $_SESSION['username'];
        $temp_image = $_FILES['image']['tmp_name'];
        
        $target_dir = 'uploads/' . $_SESSION['username'] . '/';
        
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        
        
        $target_file = $target_dir . $_FILES["image"]["name"];
        
        
        
        
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        
        if ($imageFileType != "gif") {
            array_push($errors, "Only accept gif image");
            $uploadOk = 0;
        }
        
        $temp = @imagecreatefromgif($temp_image);
        if ($temp) {
            $uploadOk = 1;
        } else {
            array_push($errors, "File is not an image");
            $uploadOk = 0;
        }
        
        if ($uploadOk == 1) {
          
          imagegif($temp,$target_file);
          imagedestroy($temp);

          $query = "INSERT INTO `pets`(`name`, `age`, `owner`, `image`) VALUES ('$name',$age,'$username','$target_file')";
                mysqli_query($db, $query);
                
                header('location: index.php');
            // if (move_uploaded_file($temp_image, $target_file)) {
            //     $query = "INSERT INTO `pets`(`name`, `age`, `owner`, `image`) VALUES ('$name',$age,'$username','$target_file')";
            //     mysqli_query($db, $query);
                
            //     header('location: index.php');
            // } else {
            //     array_push($errors, "Error in upload file!");
            // }
        } else {
            array_push($errors, "Error in upload file!!");
        }
        
    } else {
        array_push($errors, "Please fill all fields!");
    }
}