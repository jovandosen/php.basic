<?php

class Record
{
	private $name;
	private $email;
	private $password;

	private $host = 'localhost';
	private $username = 'root';
	private $pass = 'aurora';
	private $db = 'phpbasic';

	private $connection;

	public function __construct($name, $email, $password)
	{
		$this->name = $name;
		$this->email = $email;
		$this->password = password_hash($password, PASSWORD_DEFAULT);
	}

	public function connect()
	{
		$conn = new mysqli($this->host, $this->username, $this->pass, $this->db);
		if( $conn->connect_error ){
			die('Connect Error ' . $conn->connect_error);
		}
		$this->connection = $conn;
	}

	public function insert()
	{
		$sql = "INSERT INTO users(name, email, password, created) VALUES(?, ?, ?, ?)";
		$connect = $this->connection->prepare($sql);
		$currentDateTime = date('Y-m-d H:i:s');
		$connect->bind_param("ssss", $this->name, $this->email, $this->password, $currentDateTime);
		$connect->execute();
		$connect->close();
		$this->connection->close();
		$_SESSION['name'] = $this->name;
		$_SESSION['email'] = $this->email;
		header('Location: /index.php');
	}
}

?>