<h1>Profile</h1>

<?php 

$username = $_SESSION['username'];
$query = "SELECT * from users where username='$username'";
$result  = mysqli_query($db, $query);
$pets  = array();
$user = mysqli_fetch_assoc($result)
?>


	<p><?php echo $user['username']; ?></p>