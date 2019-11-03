<?php

namespace App;

class External
{
	private $connect;

	public function __construct()
	{
		$conn = new \mysqli('localhost', 'root', 'aurora', 'phpbasic');

		if( $conn->connect_error ){
			die('Connection error: ' . $conn->connect_error);
		}

		$this->connect = $conn;
	}

	public function getAllEmails()
	{
		$sql = "SELECT email FROM users";

		$records = $this->connect->query($sql);

		$emails = [];

		if( $records->num_rows > 0 ){
			while( $row = mysqli_fetch_object($records) ){
				$emails[] = $row->email;
			}
		}

		$emails = json_encode($emails);

		echo $emails;
	}
}

$external = new External();
$external->getAllEmails();

?>