<?php

namespace Libraries;
use Libraries\CustomValidator;

use Webmozart\Json\JsonEncoder;
use Webmozart\Json\JsonDecoder;
use Webmozart\Json\JsonValidator;
use Webmozart\Json\DecodingFailedException;


class JSONFormatter{
	/*
		Function: handleRequest()
		Description: 
		Main controller function. Validates input, and returns a new password.
	*/
	public function handleRequest($input = []){
		$output = $this->validateInput($input); // Validate and set defaults for all input.
		
		//dd($output);

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
			'text' => '',
			'mode' => 'editor',
		];

		$input = array_merge($defaults, $input);
		$output = []; // Output are variables that will be available to the html page.
		$output['errors'] = [];
		CustomValidator::validateField($input, $output, $defaults, 'text', 'string');
		CustomValidator::validateField($input, $output, $defaults, 'mode', 'required|in:editor,fullscreenEditor,fullscreenSimple');
		
		$decoder = new JsonDecoder();
		$encoder = new JsonEncoder();
		$encoder->setPrettyPrinting(true);
		$encoder->setEscapeSlash(false);

		try{
			if($output['text']){
				$data = $decoder->decode($output['text']);
				$output['text'] = $encoder->encode($data);
			}
		} catch(DecodingFailedException $e){
			$output['errors']['text'] = $e->getMessage();
		}

		return $output;
	}

   

}