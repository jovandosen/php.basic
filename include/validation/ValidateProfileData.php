<?php

namespace App\validation;

use App\validation\Validator;

class ValidateProfileData extends Validator
{
	public function __construct($name, $email)
	{	
		parent::__construct($name, $email, '');
	}	
}	

?>