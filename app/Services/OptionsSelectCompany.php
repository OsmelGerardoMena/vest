<?php

namespace Vest\Services;

use Vest\User;

// para la vista fields y search de views/dashboard/products/partials
// y para la vista search_unallocated de views/dashboard/myproducts/partials
class OptionsSelectCompany
{
	public function get($bool = false)
	{
		$companies = ($bool) ? User::where('type_id', 3)->where('status_id', 1)->get() 
						: User::where('type_id', 3)->get();

		$array[''] = '';

		foreach ($companies as $company) {
			$array[$company->id] = $company->name;
		}
		
		return $array;
	}
}	