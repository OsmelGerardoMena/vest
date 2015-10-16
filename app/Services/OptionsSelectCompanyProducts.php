<?php

namespace Vest\Services;

use Vest\Tables\Product;

// Para las vistas fields y search en views/dashboard/contracts
// benefits/partials, incentives/partials, trainings/partials
class OptionsSelectCompanyProducts
{
	public function get($id)
	{
		//obtengo todos las productos de una empresa especifica
		$products = Product::where('company_id', $id)->get();

		$array[''] = '';

		foreach($products as $product){
			$array [$product->id] = $product->name;
		}

		return $array;
	}
}