<?php

namespace Vest\Services;

class OptionsSelect
{
	public function get()
	{
		$types = \DB::table('user_types')->get();

		$array[""] = "";
		foreach ($types as $value) {
			$array[$value->id] = trans('dashboard.profile.'.$value->name);
		}
		return $array;
	}
}	