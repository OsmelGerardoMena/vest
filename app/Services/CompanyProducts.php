<?php

namespace Vest\Services;

use Vest\User;

class CompanyProducts
{
	public function get()
	{
		//obtengo todos las empresas. Deben tener el id = 3
		$companies = User::where('type_id', 3)->get();

		$all = []; //almacenara cada empresa con sus productos

		foreach ($companies as $company) {
			
			$products = $company->products;

			if(count($products) != 0){
				foreach ($products as $product) {
					$array [] = [
						'id' => $product->id,
						'name' => $product->name,
						];
				}

				$all[] = [
					'name' => $company->name,
					'products' => $array,
				];

				$array = [];
			}
		}

		return $all;
	}
}