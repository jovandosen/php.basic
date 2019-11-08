<?php

namespace App;

session_start();

$clicked = $_GET['data'];

class CookiePolicy
{
	private $connect;

	public function __construct()
	{
		$connection = new \mysqli('localhost', 'root', 'aurora', 'phpbasic');

		if( $connection->connect_error ){
			die('Connection error: ' . $connection->connect_error);
		}

		$this->connect = $connection;
	}

	public function insertMetaData($value)
	{
		$sql = "INSERT INTO metadata(metaName, metaValue) VALUES(?, ?)";

		$record = $this->connect->prepare($sql);

		$name = 'cookiePolicyConsent';

		$record->bind_param("ss", $name, $value);

		$record->execute();

		$record->close();

		$this->connect->close();

		$_SESSION["cookie-accepted"] = "accepted";

		echo "Cookie policy accepted.";
	}
}

$cookiePolicy = new CookiePolicy();
$cookiePolicy->insertMetaData($clicked);

?>