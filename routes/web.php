<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get("/", "PageController@home")->name("home");

Route::get("/lorem-ipsum", "LoremIpsumController@index")->name("lorem-ipsum.index");

Route::get("/user-generator", "UserGeneratorController@index")->name("user-generator.index");

Route::get("/password-generator", "PasswordGeneratorController@index")->name("password-generator.index");

Route::get("/image-generator", "ImageGeneratorController@index")->name("image-generator.index");
Route::post("/image-generator", "ImageGeneratorController@index")->name("image-generator.index");


Route::get("/json-formatter", "JSONFormatterController@index")->name("json-formatter.index");
Route::post("/json-formatter", "JSONFormatterController@index")->name("json-formatter.index");
