<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\CompanyCategories;

/* 
* Este controlador es para usuarlo en el apartado 'Lista de categorias' cuando 
* se loguea un vendedor
*/
class CategoriesAndCompaniesController extends Controller
{
    public function __construct()
	{
		$this->user = \Auth::user();
		$this->middleware('is_seller');
	}

    public function getIndex()
    {
    	$categories = CompanyCategories::get();
    	return view('dashboard.categoriesandcompanies.index')
    			->with('categories', $categories);
    }
}
