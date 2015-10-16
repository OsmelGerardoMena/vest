<?php

namespace Vest\Services;

use Vest\Tables\Customer;

// Para las vistas fields y search en views/dashboard/sales/partials
class OptionsSelectCustomer
{
	// $bool sera true si se necesita verificar el status del cliente
	public function get($bool = false)
	{
		//si $bool es true obtengo solo los clientes activos, si no todos
		$customers = ($bool) ? Customer::where('status', true)->get() : Customer::all();

		$array[''] = '';

		foreach($customers as $customer){
			$array [$customer->id] = $customer->name;
		}

		return $array;
	}
}