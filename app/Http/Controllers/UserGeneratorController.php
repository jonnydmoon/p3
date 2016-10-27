<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Libraries\UserGenerator;

class UserGeneratorController extends Controller
{
	public function index(Request $request)
	{
		$userGenerator = new UserGenerator();
		$output = $userGenerator->handleRequest( $request->all() );
		return view('user-generator.index')->with($output);
	}
}

