<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Libraries\JSONFormatter;

class JSONFormatterController extends Controller
{
    public function index(Request $request)
    {
        $jsonFormatter = new JSONFormatter();
        $output = $jsonFormatter->handleRequest( $request->all() );
        return view('json-formatter.index')->with($output);
    }
}
