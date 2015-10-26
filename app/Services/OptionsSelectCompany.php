<?php

namespace Vest\Services;

use Vest\User;

// para la vista fields y search de views/dashboard/products/partials
// y para la vista search_unallocated de views/dashboard/myproducts/partials
class OptionsSelectCompany
{
	public function get($bool = false)
	{
		// whereNotIn se usa para que no aparezca la empresa general
		$companies = ($bool) ? User::whereNotIn('id', [2])->where('type_id', 3)
				->where('status_id', 1)->get() 
				: User::whereNotIn('id', [2])->where('type_id', 3)->get();

		$array[''] = '-- '.trans('dashboard.selectors.companies').' --';

		foreach ($companies as $company) {
			$array[$company->id] = $company->name;
		}
		
		return $array;
	}
}	