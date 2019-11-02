<?php

namespace App\validation;

use App\validation\Validator;

class ValidateLogin extends Validator
{
	public function __construct($email, $password)
	{
		parent::__construct('', $email, $password);
	}
}

?>