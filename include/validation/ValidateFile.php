<?php

namespace App\validation;

class ValidateFile
{
	private $files;

	private $uploadPath = 'C:\xampp\htdocs\php.basic\assets\images\uploads\\';

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

		$fileTempName = $avatar['avatar']['tmp_name'];

		$fileErrorMessage = false;

		if( ($fileType != 'jpg') && ($fileType != 'jpeg') && ($fileType != 'png') ){
			$fileErrorMessage = 'Only jpg, jpeg and png files are allowed.';
			return array(false, $fileErrorMessage);
		}

		if( $fileSize > 5242880 ){
			$fileErrorMessage = 'File is too large, max file size is 5MB.';
			return array(false, $fileErrorMessage);
		}

		if( file_exists($this->uploadPath . $fileName) ){
			$fileErrorMessage = 'File already exists.';
			return array(false, $fileErrorMessage);
		}

		if( $fileError === 0 && $fileErrorMessage === false ){

			$result = move_uploaded_file($fileTempName, $this->uploadPath . $fileName);

			if($result){
				return array(true, $fileName);
			} else {
				$fileErrorMessage = 'Error while uploading file.';
				return array(false, $fileErrorMessage);
			}
		} 

	}
}

?>