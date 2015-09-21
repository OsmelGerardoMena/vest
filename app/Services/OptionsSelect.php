<?php

namespace Vest\Services;

class OptionsSelect
{
	public function get()
	{
		$types = \DB::table('user_types')->where('status_id', '=', '1')->get();

		$array[""] = "";
		foreach ($types as $value) {
			$array[$value->id] = $value->name;
		}
		return $array;
	}
}	