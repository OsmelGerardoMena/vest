<?php

namespace Vest\Services;

use Vest\User;

class OptionsSelectSearchCompany
{
	public function get()
	{
		$companies = User::where('type_id', 3)->get();

		$array[''] = '';

		foreach ($companies as $company) {
			$array[$company->id] = $company->name;
		}
		
		return $array;
	}
}	