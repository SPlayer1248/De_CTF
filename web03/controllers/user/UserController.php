<?php 


class UserController
{
	
	function __construct()
	{
		if (isset($_GET['a'])) {
			switch ($_GET['a']) {
				case 'login':
					$this->login();
					break;
				case 'register':
					$this->register();
					break;
				case 'logout':
					$this->logout();
					break;
				default:
					# code...
					break;
			}
		}
	}

	public function login(){
		if(isset($_POST['login'])){
			$username = $_POST['username'];
			$password = $_POST['password'];

			if($username && $password){
				$user = new User();
				$user->set_name($username);
				$user->set_pass($password);
				if($user->login() === 'ok'){
					header('location: index.php?c=user&a=home');
					exit();
				} else {
					$err = "Invalid username or password";
				}
			}
		}
		include('views/user/login.php');
	}

	
	public function register() {
		if (isset($_POST['regisrer'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			echo $username;
			echo $password;
			if($username && $password){
				$user = new user();
				$user->set_name($username);
				$user->set_pass($password);
				if ($user->add_user() == "Fail") {
					$err = "<span>The username already exists</span>";
				} else {
					$err = "<span>Successful registered!! <a href='#'>Login</a></span>";
				}
			}
		}

		include('views/user/register.php');
	}


	public function delete() {
		if(isset($_SESSION['level'])==1){
			if (isset($_GET['u'])) {
				$u = $_GET['u'];
				$user = new user();
				$user->set_name($u);

				if ($user->select_user() == "Fail") {
					header('location: index.php?c=user&a=list');
					exit();
				} else {
					$user->del_user();
					header('location: index.php?c=user&a=list');
					exit();
				}
			}
		} else{
			header('location: index.php?c=user&a=login');
		}
	}

	public function logout() {
		if(isset($_SESSION['name'])){
			session_destroy();
			header('location: index.php');
			exit();
		} else {
			die("Bad request");
		}
	}
}
?>