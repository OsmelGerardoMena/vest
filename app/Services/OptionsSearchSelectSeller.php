<?php

namespace Vest\Services;

use Vest\User;

class OptionsSearchSelectSeller
{
	public function get()
	{
		//obtengo todos los vendedores
		$sellers = User::where('type_id', 2)->get();

		$array[''] = '';

		foreach($sellers as $seller){
			$array [$seller->id] = $seller->name;
		}

		return $array;
	}
}