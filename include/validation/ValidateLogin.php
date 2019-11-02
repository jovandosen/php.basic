<?php

require 'Validator.php';

class ValidateLogin extends Validator
{
	public function __construct($email, $password)
	{
		parent::__construct('', $email, $password);
	}
}

?>