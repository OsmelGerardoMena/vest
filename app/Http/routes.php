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

// Ruta para la raiz
Route::get('/', [
	'middleware' => 'guest', 
	function () { return view('auth.login'); }
]);

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

// Password reset link request routes...
Route::get('password/email', [
	'uses' => 'Auth\PasswordController@getEmail',
	'as' => 'password/email',
]);
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Ruta para el dashboard
Route::get('dashboard', [
		'middleware' => 'auth',
		'uses' => function(){ return view('dashboard.home'); },
		'as' => 'dashboard'
]);

// Rutas para el admin
Route::group(['middleware' => ['auth', 'is_admin', 'is_active'], 
				'namespace' => 'Dashboard'], function(){

	Route::get('dashboard/users/status/{id}', [
			'uses' => 'UsersController@userStatus',
			'as' => 'dashboard.users.status'
	]);
	Route::resource('dashboard/users', 'UsersController');

	Route::get('dashboard/sellers/link/{seller_id}', [
			'uses' => 'SellersController@productLink',
			'as' => 'dashboard.sellers.link'
	]);
	Route::resource('dashboard/sellers', 'SellersController', 
		['except' => ['create', 'store']]);

	Route::get('dashboard/products/status/{id}', [
			'uses' => 'ProductsController@productStatus',
			'as' => 'dashboard.products.status'
	]);
	Route::resource('dashboard/products', 'ProductsController');

	Route::resource('dashboard/contracts', 'ContractsController', 
		['except' => 'show']);

	Route::resource('dashboard/incentives', 'IncentivesController', 
		['except' => 'show']);

	Route::resource('dashboard/trainings', 'TrainingsController');

	Route::resource('dashboard/benefits', 'BenefitsController', 
		['except' => 'show']);

	Route::get('dashboard/product-sellers/link/{product_id}', [
			'uses' => 'ProductSellersController@sellerLink',
			'as' => 'dashboard.product-sellers.link'
	]);
	Route::resource('dashboard/product-sellers', 'ProductSellersController', 
		['only' => ['show', 'destroy']]);

	Route::resource('dashboard/account', 'AccountsController', 
		['only' => ['index', 'edit', 'update']]);

	Route::resource('dashboard/companies', 'CompaniesController', 
		['only' => ['index', 'show', 'destroy']]);

	Route::get('dashboard/customers/status/{id}', [
			'uses' => 'CustomersController@customerStatus',
			'as' => 'dashboard.customers.status'
	]);
	Route::resource('dashboard/customers', 'CustomersController');

	Route::post('dashboard/sales/seller', [
			'uses' => 'SalesController@relatedProducts',
			'as' => 'dashboard.sales.seller'
	]);
	Route::resource('dashboard/sales', 'SalesController');

	/*Route::get('dashboard/profiles/status/{id}', [
			'uses' => 'ProfilesController@profileStatus',
			'as' => 'dashboard.profiles.status'
	]);
	Route::resource('dashboard/profiles', 'ProfilesController');*/
});

// Rutas para el vendedor y la empresa
Route::group(['middleware' => ['auth', 'is_active'], 'namespace' => 'Dashboard'], function(){

	Route::resource('dashboard/account', 'AccountsController', 
			['only' => ['index', 'edit', 'update'] ]);

	Route::controller('dashboard/my-products', 'MyProductsController', [
		'getIndex' => 'dashboard.myproducts.index',
		'getShow' => 'dashboard.myproducts.show',
		'getUnallocated' => 'dashboard.myproducts.unallocated',
	]);

	Route::resource('dashboard/trainings', 'TrainingsController', ['only' => 'show']);

	Route::controller('dashboard/company-sales', 'CompanySalesController', [
		'getIndex' => 'dashboard.companysales.index',
		//'getProductsSales' => 'dashboard.companysales.productssales',
		//'getSellersSales' => 'dashboard.companysales.show',
	]);
});