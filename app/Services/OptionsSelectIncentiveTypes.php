<?php

namespace Vest\Services;

use Vest\Tables\IncentiveTypes;

// para la vista fields de views/dashboard/incentives/partials
class OptionsSelectIncentiveTypes
{
	public function get()
	{
		$types = IncentiveTypes::all();

		$array[''] = '-- '.trans('dashboard.ph.incentive_type').' --';
		foreach ($types as $value) {
			$array[$value->id] = $value->name;
		}
		return $array;
	}
}