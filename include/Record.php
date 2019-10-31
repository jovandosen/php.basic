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

	public function insert()
	{
		$sql = "INSERT INTO users(name, email, password) VALUES(?, ?, ?)";
		$connect = $this->connection->prepare($sql);
		$connect->bind_param("sss", $this->name, $this->email, $this->password);
		$connect->execute();
		$connect->close();
		$this->connection->close();
	}
}

?>