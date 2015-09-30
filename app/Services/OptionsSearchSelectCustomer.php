<?php

namespace Vest\Services;

use Vest\Tables\Customer;

class OptionsSearchSelectCustomer
{
	public function get()
	{
		//obtengo todos los cientes
		$customers = Customer::all();

		$array[''] = '';

		foreach($customers as $customer){
			$array [$customer->id] = $customer->name;
		}
		
		return $array;
	}
}