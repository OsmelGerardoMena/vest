<?php

namespace Vest\Services;

use Vest\Tables\Product;

// Para las vistas fields y search en views/dashboard/sales/partials
// Para las vistas fields y search en views/dashboard/contracts/partials
// benefits/partials, incentives/partials, trainings/partials
class OptionsSelectProduct
{
	// $bool sera true si se necesita verificar el status del producto
	public function get($bool = false)
	{
		// si $bool es true obtengo solo los productos activos
		$products = ($bool) ? Product::where('status_id', 1)->get() : Product::all();

		$array[''] = '';

		foreach($products as $product){
			$array [$product->id] = $product->name;
		}

		return $array;
	}
}