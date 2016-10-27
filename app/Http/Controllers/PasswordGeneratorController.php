<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Libraries\PasswordGenerator;


class PasswordGeneratorController extends Controller
{
    public function index(Request $request)
    {
        $passwordGenerator = new PasswordGenerator();
        $output = $passwordGenerator->handleRequest( $request->all() );
        return view('password-generator.index')->with($output);
    }
}

