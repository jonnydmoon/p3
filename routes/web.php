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

function generateRoutes($entity, $controllerName, $routes){
	if(in_array('index',   $routes)) { Route::get("/$entity",           "$controllerName@index")->name("$entity.index"); }
	if(in_array('create',  $routes)) { Route::get("/$entity/create",    "$controllerName@create")->name("$entity.create"); }
	if(in_array('store',   $routes)) { Route::post("/$entity",          "$controllerName@store")->name("$entity.store"); }
	if(in_array('show',    $routes)) { Route::get("/$entity/{id}",      "$controllerName@show")->name("$entity.show"); }
	if(in_array('edit',    $routes)) { Route::get("/$entity/{id}/edit", "$controllerName@edit")->name("$entity.edit"); }
	if(in_array('update',  $routes)) { Route::put("/$entity/{id}",      "$controllerName@update")->name("$entity.update"); }
	if(in_array('destroy', $routes)) { Route::delete("/$entity/{id}",   "$controllerName@destroy")->name("$entity.destroy"); }
}





generateRoutes('lorem-ipsum', 'LoremIpsumController', ['index', 'store']);

generateRoutes('user-generator', 'UserGeneratorController', ['index', 'store']);

generateRoutes('password-generator', 'PasswordGeneratorController', ['index', 'store']);