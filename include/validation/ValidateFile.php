<?php

namespace App\validation;

class ValidateFile
{
	private $files;

	private $uploadPath = '';

	public function __construct($files)
	{
		$this->files = $files;
	}

	public function validateAvatarData()
	{
		$avatar = $this->files;

		$fileName = basename($avatar['avatar']['name']);

		$fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

		$fileSize = $avatar['avatar']['size'];

		$fileError = $avatar['avatar']['error'];

		$fileErrorMessage = false;

		if( ($fileType != 'jpg') && ($fileType != 'jpeg') && ($fileType != 'png') ){
			$fileErrorMessage = 'Only jpg, jpeg and png files are allowed.';
		}

		if( $fileSize > 5242880 ){
			$fileErrorMessage = 'File is too large, max file size is 5MB';
			var_dump($fileErrorMessage);
		} 

	}
}

?>