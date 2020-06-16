<?php
	include "Crud.php";
	include "authenticator.php";
	include_once "DBConnector.php";

	class User implements Crud, authenticator{
		private $user_id;
		private $first_name;
		private $last_name;
		private $city_name;
		private $username;
		private $password;
		private $image;
		private $utc_timestamp;
		private $offset;
		//We can use the class constructor to initialize our values member variables can't be instantiated from elsewhere; they're private

		function __construct($first_name,$last_name,$city_name,$username,$password,$image,$utc_timestamp,$offset){
			$this -> first_name = $first_name;
			$this -> last_name = $last_name;
			$this -> city_name = $city_name;

			$this -> username=$username;
			$this -> password = $password;
			$this-> image=$image;

			/*$this-> utc_timestamp = $utc_timestamp;
			$this-> offset = $offset;*/
		}

		//PHP doesn't allow multiple constructors, so we fake one. Because when we login, we don't have all details, we can only have username & password & we still need to use the same class. We make this method static so that we access it with the class rather than an object

		//static constructor
		public static function create(){
			$instance = new self($first_name,$last_name,$city_name,$username,$password);//I've added the variables here althought the original code was to be $instance= new self();
			//but if i used the original code, I got an error saying too few arguments were passed and exactly 5 were expected
			return $instance;
		}

		//username setter
		public function setUsername($username){
			$this -> username = $username;
		}

		//username getter
		public function getUsername(){
			return $this-> username;
		}

		//password setter
		public function setPassword($password){
			$this -> password = $password;
		}

		//password getter
		public function getPassword(){
			return $this -> password;
		}

		//user id setter
		public function setUserId($user_id){
			$this -> user_id = $user_id;
		}

		//user id getter
		public function getUserId()	{
			return $this -> $user_id;
		}


public function getUtc_timestamp(){
			return $this-> utc_timestamp;
		}

		//password setter
		public function setUtc_timestamp($password){
			$this -> utc_timestamp = $utc_timestamp;
		}
		public function getOffset(){
			return $this-> offset;
		}

		//password setter
		public function setOffset($password){
			$this -> offset = $offset;
		}



		public function save(){
			$fn = $this->first_name;
			$ln=$this->last_name;
			$city=$this->city_name;
			$uname = $this->username;
			$image = $this->image;

			$this->hashPassword();
			$pass = $this->password;

			/*$utc_timestamp = $this->utc_timestamp;
			$offset = $this->offset;*/		
			
			$conn =new DBConnector;
			$res = mysqli_query($conn->conn,"INSERT INTO user(first_name,last_name,user_city,username,password,image) VALUES ('$fn','$ln','$city','$uname','$pass', '$image')") or die ("Error" .mysql_error());
			return $res;
		}

		public function isUserExist(){
			$uname = $this->username;
			$conn = new DBConnector;
			$found = false;
			$res = mysqli_query($conn->conn,"SELECT * FROM user") or die ("Error" .mysql_error());

			while($row = mysqli_fetch_array($res)){
				if($row['username'] == $uname){
					$found = true;
				}
			}
			$conn -> closeDatabase();
			return $found;
		}

		public function readAll(){
			$conn =new DBConnector;			
			$query = mysqli_query($conn->conn,"SELECT * FROM user") or die ("Error" .mysql_error());
			return $query;
		}
		public function readUnique(){
			return null;
		}
		public function search(){
			return null;
		}
		public function update(){
			return null;
		}
		public function removeOne(){
			return null;
		}
		public function removeAll(){
			return null;
		}

		public function valiteForm(){
			//return true if the values are not empty
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			if($fn == "" || $ln == "" || $city == ""){
				return false;
			}
			return true;
		}

		public function createFormErrorSessions(){
			session_start();
			$_SESSION['form_errors']="All fields are required";
		}

		public function hashPassword(){
			//inbuilt function password_hash hashes our password
			$this -> password = password_hash($this-> password, PASSWORD_DEFAULT);
		}

		public function isPassWordCorrect(){
			$conn = new DBConnector;
			$found = false;
			$res = mysqli_query($conn->conn,"SELECT * FROM user") or die ("Error" .mysql_error());

			while ($row = mysqli_fetch_array($res)){
				if(password_verify($this -> getPassword(), $row['password']) && $this -> getUsername() == $row['username']){
					$found = true;
				}
			}
			//close DB Connection
			$conn -> closeDatabase();
			return $found;
			//return true;
		}

		public function login(){
			if ($this -> isPasswordCorrect()){
				//password is correct, so we load the protected page
				header("Location:private_page.php");
			}
		}

		public function createUserSession(){
			session_start();
			$_SESSION['username'] = $this -> getUsername();
		}

		public function logout(){
			session_start();
			unset($_SESSION['username']);
			session_destroy();
			header("Location:lab1.php");
		}


	}
?>