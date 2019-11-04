<?php

namespace App\validation;

use App\validation\Validator;

class ValidateForgotPassword extends Validator
{
	public function __construct($email)
	{
		parent::__construct('', $email, '');
	}
}

?>