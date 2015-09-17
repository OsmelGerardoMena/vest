<?php

namespace Vest\Services;

use Vest\Tables\Product;

class OptionsSelectProduct
{
	public function get()
	{
		//obtengo todos las productos
		$products = Product::all();

		$array[''] = '';

		foreach($products as $product){
			if($product->isActive()){ //solo los activos
				$array [$product->id] = $product->name;
			}
		}

		return $array;
	}
}