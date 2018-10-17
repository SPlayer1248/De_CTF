<?php 
	
	ob_start();
	session_start();
	include('library/autoload.php');
	include('library/database.php');

?>
 
<!DOCTYPE html>
<html>
<head>
	<title>Chat system</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php 
		if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
			echo '<p>Welcome '.$_SESSION['username'].'</p>';
			echo '<p><a href="index.php?c=user&a=logout">Logout</a></p>';
			echo '<br>';
		}
		if(isset($_GET['c'])){
			switch ($_GET['c']) {
				case 'user':
					// include('controllers/user/controller.php');
					require_once('controllers/user/UserController.php');
					$userController = new UserController();
					break;
				default:
					header('location: index.php');
					exit();
					break;
			}
		}  else {
				header('location: index.php?c=user&a=login');
				exit();
			}
	 ?>
</body>
</html>