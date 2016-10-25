<?php

namespace Libraries;
use Libraries\CustomValidator;
use Illuminate\Support\Facades\Input;

class ImageGenerator{
	const IMAGE_DIR = __DIR__ . '/../public/imagecache/';
	const IMAGE_CACHE_IN_SECONDS = 60;


	/*
		Function: handleRequest()
		Description: 
		Main controller function. Validates input, and returns a new password.
	*/
	public function handleRequest($input = []){
		$output = $this->validateInput($input); // Validate and set defaults for all input.
		

		$output['images'] = [];


		if(!array_key_exists('photo', $output['errors']) && $output['photo']){
			$this->removeOldFiles();

			$dirname = (time() + self::IMAGE_CACHE_IN_SECONDS) . '-' . microtime(true) . rand(0,100000);
			mkdir(self::IMAGE_DIR . $dirname);

			$filename = $output['photo']->getClientOriginalName();
			$path_parts = pathinfo($filename);
			$baseFileName = $path_parts['filename'] . '-' . $output['width'] .'x'. $output['height'] . '-';
			$baseName = $output['width'] .'px x '. $output['height'] . 'px';
			$baseDirName = 'imagecache/' . $dirname . '/';

			$filename = $baseFileName . 'fit.' . $path_parts['extension'];
			$output['images'][] = ['name' => "Grow To Fit: $baseName", 'src'=> $baseDirName . $filename];
			\Image::make($output['photo'])->fit($output['width'], $output['height'])->save(self::IMAGE_DIR . $dirname . '/' .$filename, $output['quality']);

			$filename = $baseFileName . 'shrink.' . $path_parts['extension'];
			$output['images'][] = ['name' => "Shrink To Fit: $baseName", 'src'=> $baseDirName . $filename];
			\Image::make($output['photo'])
				->heighten($output['height'])
				->widen($output['width'], function($constraint){  $constraint->upsize(); })
				->resizeCanvas($output['width'], $output['height'])
				->save(self::IMAGE_DIR . $dirname . '/' .$filename, $output['quality']);


			$data = file_get_contents(self::IMAGE_DIR . $dirname . '/' .$filename);
			$base64 = 'data:image/' . $path_parts['extension'] . ';base64,' . base64_encode($data);
			$output['base64'] = $base64;



			$filename = $baseFileName . 'widen.' . $path_parts['extension'];
			$output['images'][] = ['name' => "Fit Width: $output[width]px", 'src'=> $baseDirName . $filename];
			\Image::make($output['photo'])->widen($output['width'])->save(self::IMAGE_DIR . $dirname . '/' .$filename, $output['quality']);


			$filename = $baseFileName . 'heighten.' . $path_parts['extension'];
			$output['images'][] = ['name' => "Fit Height: $output[height]px", 'src'=> $baseDirName . $filename];
			\Image::make($output['photo'])->heighten($output['height'])->save(self::IMAGE_DIR . $dirname . '/' .$filename, $output['quality']);



		}

		return $output;
	}


	public function removeOldFiles(){
		foreach (glob(self::IMAGE_DIR . "*.*") as $dirname) {
    		$time = str_replace(self::IMAGE_DIR, '', $dirname);
    		$time = explode('/', $time);
    		$time = explode('-', $time[0]);

    		if( time() > $time[0] ){
				$files = array_diff(scandir($dirname), array('.','..')); 
				foreach ($files as $file) { 
					unlink("$dirname/$file"); 
				} 
				rmdir($dirname);
    		}
		}
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
			'width' => 100,
			'height' => 100,
			'quality' => 90,
			'photo' => '',
		];

		$requiredPhoto = array_key_exists('userSubmitted', $input) ? '|required' : '';

		$input = array_merge($defaults, $input);
		$output = []; // Output are variables that will be available to the html page.
		$output['errors'] = [];
		CustomValidator::validateField($input, $output, $defaults, 'width',  'required|numeric|min:5|max:1000', null, true);
		CustomValidator::validateField($input, $output, $defaults, 'height', 'required|numeric|min:5|max:1000', null, true);
		CustomValidator::validateField($input, $output, $defaults, 'quality', 'required|numeric|min:1|max:100', null, true);
		CustomValidator::validateField($input, $output, $defaults, 'photo', "max:10000|mimes:jpg,jpeg,gif,png$requiredPhoto", 'You must submit a file and it must be less than 10mb and be .jpg, .png, or .gif.');

		$output['base64'] = ''; // Placeholder for the base64 encoding.

		return $output;
	}
}