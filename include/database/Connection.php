<?php

namespace App\database;

class Connection
{
	private $host = 'localhost';
	private $username = 'root';
	private $password = 'aurora';
	private $db = 'phpbasic';

	public $connect;

	public function __construct()
	{
		$conn = new \mysqli($this->host, $this->username, $this->password, $this->db);

		if( $conn->connect_error ){
			die('Connection error: ' . $conn->connect_error);
		}

		$this->connect = $conn;
	}

}

?>