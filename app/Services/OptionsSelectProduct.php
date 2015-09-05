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

		foreach ($products as $product) { //solo los activos

			if($product->status->type == 'active'){
				
				$array [$product->id] = $product->name;
			}
		}

		return $array;
	}
}