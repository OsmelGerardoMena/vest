<?php

namespace Vest\Services;

use Illuminate\Support\Facades\Auth;

use Vest\Tables\Product;

// Para las vistas fields y search en views/dashboard/contracts
// benefits/partials, incentives/partials, trainings/partials y sales/partials
// solo cuando el usuario es de tipo empresa
class OptionsSelectCompanyProducts
{
	public function get()
	{
		//obtengo todos las productos de una empresa especifica
		$products = Product::where('company_id', Auth::user()->id)->get();

		$array[''] = '-- '.trans('dashboard.selectors.products').' --';

		foreach($products as $product){
			$array [$product->id] = $product->name;
		}

		return $array;
	}
}