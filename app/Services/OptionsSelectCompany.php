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

			if($company->status->type == 'active'){

				$array[$company->id] = $company->name;
			}
		}
		
		return $array;
	}
}	