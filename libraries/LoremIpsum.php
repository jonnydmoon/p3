<?php

namespace Libraries;
use Libraries\CustomValidator;

class LoremIpsum{
	/*
		Function: handleRequest()
		Description: 
		Main controller function. Validates input, and returns a new password.
	*/
	public function handleRequest($input = []){
		$output = $this->validateInput($input); // Validate and set defaults for all input.
		$words = $this->getWords($output['numberOfParagraphs'], $output['paragraphLength']);
		$output['words'] = $words;
		return $output;
	}

	/*
		Function: getWords(number, number)
		Description: 
		Gets the words from the file based off of the number of paragraphs and paragraph length.
	*/
	private function getWords($numberOfParagraphs, $paragraphLength){
		$words = file( __DIR__ . '/data/lorem.txt', FILE_IGNORE_NEW_LINES);
		$str = '';

		// for each paragraph generate a random number of sentences.
		for($i = 0; $i < $numberOfParagraphs; $i++){
			$currentParagraphLength = $paragraphLength + rand(0, 2); // Make the paragraphs a little bigger or smaller.
		
			for($j = 0; $j < $currentParagraphLength; $j++){
				$currentLine = rand(0, count($words) - 1);
				$str .= $words[$currentLine] . ' ';
			}
			$str .= "\n\n";
		}
		return trim($str);
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
			'numberOfParagraphs' => 3,
			'paragraphLength' => 1,
		];

		$input = array_merge($defaults, $input);
		$output = []; // Output are variables that will be available to the html page.
		$output['errors'] = [];
		CustomValidator::validateField($input, $output, $defaults, 'numberOfParagraphs', 'required|numeric|min:1|max:99', null, true);
		CustomValidator::validateField($input, $output, $defaults, 'paragraphLength', 'required|numeric|in:1,4,6', null, true);
		return $output;
	}
}