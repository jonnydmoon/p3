<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class PageController extends Controller
{
	public function home()
	{
		$links = [
			[
				'title'       => 'Lorem Ipsum',
				'description' => 'Create random blocks of lorem ipsum text.',
				'icon'        => 'fa-file-text',
				'url'         => URL::route('lorem-ipsum.index')
			],
			[
				'title'       => 'User Generator',
				'description' => 'Generate random user data.',
				'icon'        => 'fa-user',
				'url'         => URL::route('user-generator.index')
			],
			[
				'title'       => 'Password Generator',
				'description' => 'Create strong, random passwords that are easy to remember.',
				'icon'        => 'fa-unlock-alt',
				'url'         => URL::route('password-generator.index')
			],
			[
				'title'       => 'Image Generator',
				'description' => 'Resize and crop images.',
				'icon'        => 'fa-picture-o',
				'url'         => URL::route('image-generator.index')
			],
			[
				'title'       => 'JSON Formatter',
				'description' => 'Format JSON into a readable form.',
				'icon'        => 'fa-file-code-o',
				'url'         => URL::route('json-formatter.index')
			]
		];

		return view('home')->with(['links' => $links]);
	}

}
