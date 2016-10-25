<?php

namespace Libraries;

use Illuminate\Support\Facades\Validator;

class CustomValidator{

	static function validateField(&$input, &$output, $defaults, $key, $validator, $message = null, $forceToNumber = false){
		if(Validator::make($input, [$key => $validator])->fails()){
			$output['errors'][$key] = $message ? $message : "Invalid value for $key. Defaulting to '$defaults[$key]'.";
			$input[$key] = $defaults[$key];
		}
		$output[$key] = $forceToNumber ? +$input[$key] : $input[$key];
	}
}