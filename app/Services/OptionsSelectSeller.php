<?php

namespace Vest\Services;

use Vest\User;

class OptionsSelectSeller
{
	public function get()
	{
		//obtengo todos las vendedores
		$sellers = User::where('type_id', 2)->get();

		$array[''] = '';

		foreach($sellers as $seller){
			if($seller->isActive()){ //solo los activos
				$array [$seller->id] = $seller->name;
			}
		}

		return $array;
	}
}