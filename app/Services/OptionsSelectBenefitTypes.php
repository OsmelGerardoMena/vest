<?php

namespace Vest\Services;

class OptionsSelectBenefitTypes
{
	public function get()
	{
		$types = \DB::table('benefit_types')->get();

		$array[''] = '';
		foreach ($types as $value) {
			$array[$value->id] = trans('dashboard.'.$value->name);
		}
		return $array;
	}
}