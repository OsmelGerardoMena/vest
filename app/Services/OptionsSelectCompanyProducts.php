<?php

namespace Vest\Services;

use Vest\Tables\Product;

// Para las vistas fields y search en views/dashboard/contracts
// benefits/partials, incentives/partials, trainings/partials
// solo cuando el usuario es de tipo empresa
class OptionsSelectCompanyProducts
{
	public function get($id)
	{
		//obtengo todos las productos de una empresa especifica
		$products = Product::where('company_id', $id)->get();

		$array[''] = '-- '.trans('dashboard.selectors.products').' --';

		foreach($products as $product){
			$array [$product->id] = $product->name;
		}

		return $array;
	}
}