<?php 

	class user extends Database
	{
		protected $user_name;
		protected $user_pass;
		protected $user_level;


		function __construct()
		{
			$this->connect();
		}

		public function set_name($name){
			$this->user_name = $name;
		}

		public function get_name(){
			return $this->user_name;
		}

		public function set_pass($pass){
			$this->user_pass = $pass;
		}

		public function get_pass(){
			return $this->user_pass;
		}

		public function set_level($level){
			$this->user_level = $level;
		}

		public function get_level(){
			return $this->user_level;
		}

		public function login(){

			$sql = "SELECT * FROM users WHERE username='$this->user_name' AND password='$this->user_pass'";
			$this->query($sql);
			if($this->num_row() == 1){
				$row = $this->fetch();
				$_SESSION['name'] = $this->user_name;
				$_SESSION['level'] = $row['level'];
				return "ok";
			}
		}


		public function register(){
			$sql = "SELECT * from users where username='$this->user_name'";
			$this->query($sql);
			if($this->num_row() == 0){
				$sql = "INSERT INTO `users`(`username`, `password`) VALUES ('$this->user_name','$this->user_pass')";
				$this->query($sql);
			} else {
				return "Fail";
			}
		}


		public function select_user(){
			$sql = "SELECT * FROM users WHERE username='$this->user_name'";
			$this->query($sql);
			if($this->num_row() == 0){
				return "Fail";
			} else{
				$row=$this->fetch();
				return $row;
		
			}
			}
}	
?>