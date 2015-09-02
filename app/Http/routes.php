<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Authentication routes...
Route::get('login',[
	'uses' => 'Auth\AuthController@getLogin',
	'as'   => 'login'
]);
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('logout', [
	'uses' => 'Auth\AuthController@getLogout',
	'as'   => 'logout'
]);

// Registration routes...
/*Route::get('register', [
	'uses' => 'Auth\AuthController@getRegister',
	'as'   => 'register'
]);
Route::post('auth/register', 'Auth\AuthController@postRegister');*/


Route::group(['middleware' => 'auth', 'namespace' => 'Dashboard'], function(){

	Route::get('dashboard', function(){
		return view('dashboard.home');
	});

	Route::resource('dashboard/users', 'UsersController');
	Route::resource('dashboard/profiles', 'ProfilesController');
	Route::resource('dashboard/products', 'ProductsController');
	Route::resource('dashboard/sellers', 'ProductsUsersController');
});




/*Route::group(['middleware' => 'auth'], function(){
	Route::resource('dashboard', 'AdminController', ['only' => ['index', 'create']]);
});*/
