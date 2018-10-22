 <?php
session_start();
define('DBUSER', 'root');
define('DBPWD', '');
define('DBHOST', 'localhost');
define('DBNAME', 'ctf_web02');
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
    mysqli_free_result($result);
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
            $_SESSION['level']    = mysqli_fetch_assoc($results)['level'];
            mysqli_free_result($result);
            header('location: index.php');
        } else {
            
            array_push($errors, "Wrong username/password combination");
        }
    }
}



if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $current_user = $_SESSION['username'];
    $query        = "SELECT * FROM messages WHERE sender='$current_user' OR receiver='$current_user' ORDER BY date DESC";
    
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

        mysqli_free_result($result);
    }
}


if (isset($_POST['del_post'])){
    $id = $_POST['id'];
    $query = "DELETE FROM posts WHERE id=$id";
    echo $query;
    $result = mysqli_query($db, $query);
    if ($result) {
        
    } else {
        array_push($errors, "Error");
    }
}




$query = "SELECT * from posts";
$results = mysqli_query($db, $query);

$posts = array();

if($results){
    while ($line = mysqli_fetch_assoc($results)) {
        array_push($posts,$line);
    }
    mysqli_free_result($results);
} 


if (isset($_POST['add_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username'];

    $query = "INSERT INTO posts(title, content, author) VALUES ('$title','$content','$author')";
    $results = mysqli_query($db, $query);

    if($results){
        mysqli_free_result($result);
        header('location: index.php');
    } else {
        array_push($errors,"Error");
    }
}

if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_GET['id'];

    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($db, $query);

    if($result){
        $editPost = mysqli_fetch_assoc($result);
        if ($editPost['author'] !== $_SESSION['username']) {
            $editPost = '';
        }
        mysqli_free_result($result);
    } else {
        array_push($errors, "Error");
    }
}

if (isset($_POST['edit_post'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username'];
    $query = "UPDATE posts SET title='$title',content='$content',author='$author' WHERE id=$id";
    $result = mysqli_query($db, $query);
    if ($result) {
        mysqli_free_result($result);
        header('location: index.php');
    }
 else {
        array_push($errors, "Error");
    }}