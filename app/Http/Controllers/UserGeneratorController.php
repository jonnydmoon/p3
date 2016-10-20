<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Libraries\UserGenerator;

class UserGeneratorController extends Controller
{
		public function __construct(Request $request)//Dependency injection
	{
		$this->request = $request;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$userGenerator = new UserGenerator();
		$output = $userGenerator->handleRequest( $this->request->all() );
		return view('user-generator.index')->with($output);
	}

}

