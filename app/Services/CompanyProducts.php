<?php

namespace Vest\Services;

use Vest\User;
// Esta clase no se esta usando, ahora se esta usando Companies
// Para la vista fields de views/dashboard/sellers/partials
class CompanyProducts
{
	public function get()
	{
		//obtengo todas las empresas. Deben tener el id = 3
		$companies = User::where('type_id', 3)->get();

		$all = []; //almacenara cada empresa con sus productos
		$array = []; // para almacenar la info de cada producto

		foreach ($companies as $company) {
			
			$products = $company->products;

			if(count($products) != 0){
				foreach ($products as $product) {
					if($product->isActive()){
						$array [] = [
						'id' => $product->id,
						'name' => $product->name,
						];
					}
				}

				$all[] = [
					'id' => $company->id,
					'name' => $company->name,
					'products' => $array,
				];

				$array = [];
			}
		}
		return $all;
	}
}