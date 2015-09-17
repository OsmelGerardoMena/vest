<?php

namespace Vest\Services;

use Vest\Tables\Product;

class OptionsSearchSelectProduct
{
	public function get()
	{
		//obtengo todos las productos
		$products = Product::all();

		$array[''] = '';

		foreach($products as $product){
			$array [$product->id] = $product->name;
		}

		return $array;
	}
}