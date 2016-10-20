<?php

namespace Libraries;
use Libraries\CustomValidator;


class PasswordGenerator
{
	/*
		Handles the logic for the password generator. 
	*/
	 
	/*
		Function: handleRequest()
		Description: 
		Main controller function. Validates input, and returns a new password.
	*/
	public function handleRequest($input = []){
		$output = $this->validateInput($input); // Validate and set defaults for all input.

		$words = $this->getWords($output['numberOfWords']);

		$words = $this->transformTextCasing($words, $output['textTransform']);

		$password = $this->handleDelimiter($words, $output['delimiter']);
		
		if($output['includeNumber'] === 'on'){
			$password = $this->handleIncludeNumber($password);
		}
		
		if($output['includeSymbol'] === 'on'){
			$password = $this->handleIncludeSymbol($password);
		}

		$output['password'] = $password;

		return $output;
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
			'numberOfWords' => 3,
			'includeNumber' => 'off',
			'includeSymbol' => 'off',
			'delimiter' => 'hyphen',
			'textTransform' => 'lower',
		];

		$input = array_merge($defaults, $input);
		$output = []; // Output are variables that will be available to the html page.
		$output['errors'] = [];
		CustomValidator::validateField($input, $output, $defaults, 'numberOfWords', 'required|numeric|min:1|max:9', null, true);
		CustomValidator::validateField($input, $output, $defaults, 'includeNumber', 'required|in:on,off');
		CustomValidator::validateField($input, $output, $defaults, 'includeSymbol', 'required|in:on,off');
		CustomValidator::validateField($input, $output, $defaults, 'delimiter',     'required|in:hyphen,nospace,space');
		CustomValidator::validateField($input, $output, $defaults, 'textTransform', 'required|in:camel,lower,upper,title,sentence');
		return $output;
	}

	// Returns a random number of words as an array.
	private function getWords($numberOfWords){
		$words = file( __DIR__ . '/words.csv', FILE_IGNORE_NEW_LINES);
		shuffle($words);
		return array_slice($words, 0, $numberOfWords);
	}


	// Returns an array of words that has been transformed according to the transform type.
	private function transformTextCasing($words, $type){
		switch($type){
			case 'camel':
				$words = array_map(function($word){ return ucfirst($word); }, $words);
				$words[0] = lcfirst($words[0]);
				break;
			case 'upper':
				$words = array_map(function($word){ return strtoupper($word); }, $words);
				break;
			case 'lower':
				$words = array_map(function($word){ return strtolower($word); }, $words);
				break;
			case 'title':
				$words = array_map(function($word){ return ucfirst($word); }, $words);
				break;
			case 'sentence':
				$words[0] = ucfirst($words[0]);
				break;
		}
		return $words;
	}


	// Returns a password string from an array of words joined together by a delimiter.
	private function handleDelimiter($words, $type){
		switch($type){
			case 'hyphen':
				$password = implode('-', $words);
				break;
			case 'space':
				$password = implode(' ', $words);
				break;
			case 'nospace':
				$password = implode('', $words);
				break;
		}
		return $password;
	}


	// Adds a number to the end of a string.
	private function handleIncludeNumber($password){
		$numbers = [0,1,2,3,4,5,6,7,8,9];
		shuffle($numbers);
		$password .= $numbers[0];
		return $password;
	}


	// Adds a symbol to the end of a string.
	private function handleIncludeSymbol($password){
		$symbols = ['!','@','#','$','%','&','*','?','+'];
		shuffle($symbols);
		$password .= $symbols[0];
		return $password;
	}
}