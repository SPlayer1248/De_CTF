<?php
session_start();
define('DBUSER', 'root');
define('DBPWD', '');
define('DBHOST', 'localhost');
define('DBNAME', 'ctf_web03');
$db       = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
$username = "";
$errors   = array();

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

if (isset($_GET['user']) && !empty($_GET['user'])) {
    $user         = mysqli_real_escape_string($db, $_GET['user']);
    $current_user = $_SESSION['username'];
    $received     = array();
    $send         = array();
    if (empty($user)) {
        array_push($errors, "Invalid user");
    }
    
    $query   = "SELECT * FROM messages WHERE sender='$user' and receiver='$current_user' OR sender='$current_user' and receiver='$user' ORDER BY date DESC";
    $results = mysqli_query($db, $query);
    if ($results) {
        while ($row = mysqli_fetch_assoc($results)) {
            @array_push($received, $row);
        }
    }
    
    
}

$current_user = $_SESSION['username'];
$query = "SELECT * FROM messages WHERE sender='$current_user' OR receiver='$current_user' ORDER BY date DESC";

$rs = mysqli_query($db, $query);

$contacts = array();
if ($rs) {
    while ($line = mysqli_fetch_assoc($rs)) {
        // array_push($contacts, $line);
        if ($line['sender'] == $current_user) {
            if (!in_array($line['receiver'], $contacts)) {
        
                array_push($contacts, $line['receiver']);
            }
            
        } else {
            if (!in_array($line['sender'], $contacts)) {
                
                array_push($contacts, $line['sender']);
            }
        }
    }
}