<?php

class CheckRecord
{
	private $email;
	private $password;

	private $host = 'localhost';
	private $username = 'root';
	private $pass = 'aurora';
	private $db = 'phpbasic';

	private $connection;

	public function __construct($email, $password)
	{
		$this->email = $email;
		$this->password = $password;
	}

	public function connect()
	{
		$conn = new mysqli($this->host, $this->username, $this->pass, $this->db);
		if( $conn->connect_error ){
			die('Connect Error ' . $conn->connect_error);
		}
		$this->connection = $conn;
	}

	public function checkLoginData()
	{
		$sql = "SELECT * FROM users WHERE email=?";

		$connect = $this->connection->prepare($sql);

		$connect->bind_param("s", $this->email);

		$data = $connect->execute();

		$result = $connect->get_result();

		$userName = '';
		$userEmail = '';
		$userPassword = '';

		if($result->num_rows === 1){
			while($row = mysqli_fetch_object($result)){
				$userName = $row->name;
				$userEmail = $row->email;
				$userPassword = $row->password;
			}
		} else {
			return array('email', 'Please enter correct email address');
		}

		if( password_verify($this->password, $userPassword) ){
			$_SESSION['name'] = $userName;
			$_SESSION['email'] = $userEmail;
			header('Location: /index.php'); 
		} else {
			return array('password', 'Password is not correct');
		}

	}

}

?>