<?php

namespace Libraries;
use Libraries\CustomValidator;


class UserGenerator{
	/*
		Function: handleRequest()
		Description: 
		Main controller function. Validates input, and returns a new password.
	*/
	public function handleRequest($input = []){
		$output = $this->validateInput($input); // Validate and set defaults for all input.
		$users = $this->getUsers($output['numberOfUsers'], $output['includeBirthdate']);
		$output['users'] = $users;
		return $output;
	}


	private function getUsers($numberOfUsers, $includeBirthdate){
		$func = function($value) {
			return str_getcsv($value, "\t");
		}; 
		$csv = array_map($func, file( __DIR__ . '/usercontent.csv'));
		$max = count($csv) - 1;
		$users = [];

		$femaleIndex = range(1, 100); 
		$maleIndex =range(1, 1255);
		shuffle($femaleIndex);
		shuffle($maleIndex);


		for($i = 0; $i < $numberOfUsers; $i++){
			$gender = rand(0,1) ? 'male' : 'female';
			$profileIndex = $gender === 'female' ? array_pop($femaleIndex) : array_pop($maleIndex);
			$addressIndex = rand(0, $max);
			$user = [
				"gender"    => $gender,   
				"firstName" => $csv[rand(0, $max)][ $gender === 'female' ? 0 : 1 ],
				"lastName"  => $csv[rand(0, $max)][ 2 ],
				"street"    => rand(1, 9999) . ' ' .$csv[rand(0, $max)][ 3 ],
				"city"      => $csv[$addressIndex][ 4 ],
				"state"     => $csv[$addressIndex][ 5 ],
				"zip"       => $csv[$addressIndex][ 6 ],
				"profile"   => "images/uifaces/$gender/$profileIndex.jpg",
			];
			$users[] = $user;
		}

		return $users;
	}

	/*
		Function: validateInput(associativeArray)
		Description: 
		Takes an associative array and validates input. Unexpected values are ignored.
		If an input value is not valid, an error is added to the errors field.
		No matter what, by the end of the function, output will contain valid fields.
	*/
	private function validateInput($input){
		$defaults = [
			'numberOfUsers' => 5,
			'includeBirthdate' => 'off',
		];

		$input = array_merge($defaults, $input);
		$output = []; // Output are variables that will be available to the html page.
		$output['errors'] = [];
		CustomValidator::validateField($input, $output, $defaults, 'numberOfUsers', 'required|numeric|min:1|max:99', null, true);
		CustomValidator::validateField($input, $output, $defaults, 'includeBirthdate', 'required|in:on,off');
		return $output;
	}
}