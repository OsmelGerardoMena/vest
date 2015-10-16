<?php

namespace Vest\Services;

use Vest\User;

// Para las vistas fields y search en views/dashboard/sales/partials
class OptionsSelectSeller
{
	// $bool sera true si se necesita verificar el status del vendedor
	public function get($bool = false)
	{
		//si $bool es true obtengo solo los vendedores activos
		$sellers = ($bool) ? User::where('type_id', 2)->where('status_id', 1)->get() 
					: User::where('type_id', 2)->get();

		$array[''] = '';

		foreach($sellers as $seller){
			$array [$seller->id] = $seller->name;
		}

		return $array;
	}
}