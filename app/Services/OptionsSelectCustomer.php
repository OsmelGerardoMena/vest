<?php

namespace Vest\Services;

use Vest\Tables\Customer;

class OptionsSelectCustomer
{
	public function get()
	{
		//obtengo todos los clientes activos
		$customers = Customer::where('status', true)->get();

		$array[''] = '';

		foreach($customers as $customer){
			$array [$customer->id] = $customer->name;
		}

		return $array;
	}
}