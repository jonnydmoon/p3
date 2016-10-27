<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Libraries\LoremIpsum;

class LoremIpsumController extends Controller
{
    public function index(Request $request)
    {
        $loremIpsum = new LoremIpsum();
        $output = $loremIpsum->handleRequest( $request->all() );
        return view('lorem-ipsum.index')->with($output);
    }
}
