<?php

class Validator
{
	private $name;
	private $email;
	private $password;

	public function __construct($name, $email, $password)
	{
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
	}

	public function validateName()
	{
		$nameError = false;

		$this->name = trim($this->name);

		if( empty($this->name) ){
			$nameError = 'Name can not be empty.';
			return $nameError;
		} else {
			$nameLength = strlen($this->name);
			if( $nameLength < 3 || $nameLength > 15 ){
				$nameError = 'Name must have at least 3 characters, but not more that 15';
				return $nameError;
			}
		}

		return $nameError;
	}

	public function validateEmail()
	{
		$emailError = false;

		$this->email = trim($this->email);

		if( empty($this->email) ){
			$emailError = 'Email can not be empty.';
			return $emailError;
		} else {
			if( !$this->validEmailAddress($this->email) ){
				$emailError = 'Email is not valid';
				return $emailError;
			}
		}

		return $emailError;
	}

	public function validatePassword()
	{
		$passwordError = false;

		$this->password = trim($this->password);

		if( empty($this->password) ){
			$passwordError = 'Password can not be empty.';
			return $passwordError;
		} else {
			$passwordLength = strlen($this->password);
			if( $passwordLength < 3 || $passwordLength > 15 ){
				$passwordError = 'Password must have at least 3 characters, but not more that 15';
				return $passwordError;
			}
		}

		return $passwordError;
	}

	private function validEmailAddress($email)
	{
		$result = preg_match('/\S+@\S+\.\S+/', $email);
		return $result;
	}
}

?>