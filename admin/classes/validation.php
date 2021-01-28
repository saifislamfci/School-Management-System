<?php
class Validation {
	public static $errors = [];
	public static $hasError = true;
	public static $allowedType = array('jpeg', 'jpg', 'png');		
	public static function validate ( $data ) {
		foreach ($data as $key => $value) {
			if(isset($_POST[$value['field_name']])) {
				if(isset($value['required']) && empty($_POST[$value['field_name']])) {
					self::$errors[] = ucwords(str_replace('_', ' ',$value['field_name'])) . ' Is required';
				} elseif(isset($value['min']) && strlen($_POST[$value['field_name']]) < $value['min'] ) {
					self::$errors[] = 'Minimum ' . $value['min'] . ' characters Is required for this field ' . ucwords(str_replace('_', ' ',$value['field_name']));
				}  elseif(isset($value['max']) && strlen($_POST[$value['field_name']]) > $value['max'] ) {
					self::$errors[] = 'Maximum ' . $value['max'] . ' characters Is required for ' . $value['field_name'];
				} elseif( isset($value['match']) && $_POST[$value['match']] <> $_POST[$value['field_name']]) {
					self::$errors[] = 'Both field is not equal';
				} 
			}

		
			if(isset($_FILES[$value['field_name']]['name'])) {
				
				$explode 	= explode('.', $_FILES[$value['field_name']]['name']);
				$extension 	= strtolower(end($explode));

				if( isset($value['required']) && $value['type'] == 'file' ) {
					if(!$_FILES[$value['field_name']]['name']) {
						self::$errors[] = 'Please upload a image/file';
					} elseif(!in_array($extension, self::$allowedType)) {
						self::$errors[] = 'WE are only accepting jpeg, jpg and png image file';
					}
				}
			}			

		}
		if(!empty(self::$errors)) {
			echo '<br/>';
			echo "<div class='alert-danger text-danger text-justify'>";
			foreach (self::$errors as $error) {
				echo $error.'*';
				echo '<br/>';
			
			}
			echo "</div>";
		} else {
			return self::$hasError = false;
		}
	}


}