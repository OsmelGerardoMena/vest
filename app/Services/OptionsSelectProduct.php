<?php

namespace Vest\Services;

use Vest\Tables\Product;

// Para las vistas fields y search en views/dashboard/sales/partials
// Para las vistas fields y search en views/dashboard/contracts/partials
// benefits/partials, incentives/partials, trainings/partials
class OptionsSelectProduct
{
	// $bool sera true si se necesita verificar el status del producto
	// puede recibir tambien $general, sera true si se quiere que aparezca 
	public function get($bool = false, $general = false)
	{
		if ($general) {
			// si $general es true, se buscan todos los productos
			$products = ($bool) ? Product::where('status_id', 1)->get() : Product::all();
			// si $bool es true obtengo solo los productos activos
		}
		else {
			// si $general es false, se buscan los productos excepto aquel con 
			// id = 1 el cual es el producto general
			$products = ($bool) ? Product::whereNotIn('id', [1])
				->where('status_id', 1)->get() 
				: Product::whereNotIn('id', [1])->get();
		}

		$array[''] = '-- '.trans('dashboard.selectors.products').' --';

		foreach($products as $product){
			$array [$product->id] = $product->name;
		}

		return $array;
	}
}