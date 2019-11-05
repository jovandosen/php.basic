<?php

namespace App\validation;

use App\validation\Validator;

class ValidateContactForm extends Validator
{
	private $message;

	public function __construct($name, $email, $message)
	{
		parent::__construct($name, $email, '');
		$this->message = $message;
	}

	public function validateMessage()
	{
		$messageError = false;

		$this->message = trim($this->message);

		if( empty($this->message) ){
			$messageError = 'Message can not be empty...';
			return $messageError;
		}

		return $messageError;
	}
}

?>