<?php

namespace Vest\Services;

use Illuminate\Support\Facades\Auth;

// Para las vistas fields y search en views/dashboard/sales
class OptionsSelectSellerProducts
{
	public function get()
	{
		// obtengo todos las productos del vendedor logueado si el producto general
		$products = Auth::user()->addedproducts()->whereNotIn('product_id', [1])->get();

		$array[''] = '-- '.trans('dashboard.selectors.products').' --';

		foreach($products as $product){
			$array [$product->id] = $product->name;
		}

		return $array;
	}
}