<?php

namespace App\database;

use App\database\Connection;

class ContactModel extends Connection
{
	public function create($name, $email, $message)
	{	
		$sql = "INSERT INTO contacts(name, email, message, created) VALUES(?, ?, ?, ?)";

		$created = date("Y-m-d H:i:s");

		$record = $this->connect->prepare($sql);

		$record->bind_param("ssss", $name, $email, $message, $created);

		$record->execute();

		$record->close();

		$this->connect->close();

		$_SESSION['info'] = 'Your message was sent successfully.';
	}
}

?>