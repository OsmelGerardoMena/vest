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
Route::get('login', [
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
	'as' => 'password.email',
]);
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset', [
	'uses' => 'Auth\PasswordController@postReset',
	'as' => 'password.reset',
]);

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
		['except' => ['create', 'store', 'destroy']]);

	Route::controller('dashboard/linked-sellers', 'LinkedSellersController', [
		'getProduct' => 'dashboard.linkedsellers.product',
		'getCompany' => 'dashboard.linkedsellers.company',
		'getLink' => 'dashboard.linkedsellers.link',
	]);

	Route::resource('dashboard/companies', 'CompaniesController', 
		['only' => ['index', 'show', 'destroy'] ]);

	Route::resource('dashboard/company-categories', 'CompanyCategoriesController');

	/*Route::get('dashboard/profiles/status/{id}', [
			'uses' => 'ProfilesController@profileStatus',
			'as' => 'dashboard.profiles.status'
	]);
	Route::resource('dashboard/profiles', 'ProfilesController');*/
});

// Rutas para el vendedores, empresas y administradores (Autenticados y activos)
Route::group(['middleware' => ['auth', 'is_active'], 'namespace' => 'Dashboard'], function(){

	Route::resource('dashboard/account', 'AccountsController', 
			['only' => ['index', 'edit', 'update'] ]);

	Route::get('dashboard/my-products/unallocated', [
			'uses' => 'MyProductsController@unallocated',
			'as' => 'dashboard.my-products.unallocated'
	]);
	Route::resource('dashboard/my-products', 'MyProductsController', 
			['except' => 'destroy']);

	Route::resource('dashboard/contracts', 'ContractsController', 
		['except' => 'show']);

	Route::resource('dashboard/benefits', 'BenefitsController', 
		['except' => 'show']);

	Route::resource('dashboard/incentives', 'IncentivesController', 
		['except' => 'show']);

	Route::resource('dashboard/trainings', 'TrainingsController');

	Route::controller('dashboard/company-sales', 'CompanySalesController', [
		'getIndex' => 'dashboard.companysales.index',
		//'getProductsSales' => 'dashboard.companysales.productssales',
		//'getSellersSales' => 'dashboard.companysales.show',
	]);

	Route::get('dashboard/products/status/{id}', [
			'uses' => 'ProductsController@productStatus',
			'as' => 'dashboard.products.status'
	]);
	Route::resource('dashboard/products', 'ProductsController');

	// rutas para agregar factura a las ventas
	Route::get('dashboard/sales/invoice/{id}', [
			'uses' => 'SalesController@addInvoice',
			'as' => 'dashboard.sales.invoice'
	]);
	Route::put('dashboard/sales/saveinvoice/{id}', [
			'uses' => 'SalesController@saveInvoice',
			'as' => 'dashboard.sales.saveinvoice'
	]);
	// ruta para la carga de productos del vendedor en el formulario de crear venta
	Route::get('dashboard/sales/seller', 'SalesController@sellerProducts');
	// ruta para la carga de productos del vendedor en el formulario de editar venta
	Route::get('dashboard/sales/{id}/seller', 'SalesController@sellerProducts');
	Route::resource('dashboard/sales', 'SalesController');

	Route::controller('dashboard/notifications', 'NotificationsController', [
		'getIndex' => 'dashboard.notifications.index',
		'getShow' => 'dashboard.notifications.show',
		//'getSellersSales' => 'dashboard.companysales.show',
	]);

	Route::get('dashboard/customers/status/{id}', [
			'uses' => 'CustomersController@customerStatus',
			'as' => 'dashboard.customers.status'
	]);
	Route::resource('dashboard/customers', 'CustomersController');
});