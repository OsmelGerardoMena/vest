<?php

namespace Vest\Services;

use Vest\User;

class OptionsSelectCompany
{
	public function get()
	{
		$companies = User::where('type_id', 3)->get();

		$array[''] = '';

		foreach ($companies as $company) {

			if($company->status->id == 1){ // si esta activo, se agrega

				$array[$company->id] = $company->name;
			}
		}
		
		return $array;
	}
}	