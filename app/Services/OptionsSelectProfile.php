<?php

namespace Vest\Services;

// Para las vistas fields y search en views/dashboard/users/partials
class OptionsSelectProfile
{
	public function get()
	{
		$types = \DB::table('user_types')->get();

		$array[''] = '-- '.trans('dashboard.selectors.profiles').' --';
		foreach ($types as $value) {
			$array[$value->id] = trans('dashboard.profile.'.$value->name);
		}
		return $array;
	}
}	