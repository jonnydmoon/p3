<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Libraries\ImageGenerator;

class ImageGeneratorController extends Controller
{
    public function index(Request $request)
    {
        $imageGenerator = new ImageGenerator();
        $output = $imageGenerator->handleRequest( $request->all() );
        return view('image-generator.index')->with($output);
    }
}

