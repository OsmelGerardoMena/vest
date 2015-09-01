<?php

namespace Vest\Services;

class OptionsSelectCompany
{
	public function get()
	{
		$companies = \DB::table('users')->where('type_id', '=', 3)->get();

		$array[""] = "";
		
		foreach ($companies as $company) {
			$array[$company->id] = $company->name;
		}

		return $array;
	}
}	