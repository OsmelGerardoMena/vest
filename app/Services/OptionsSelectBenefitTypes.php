<?php

namespace Vest\Services;

use Vest\Tables\BenefitTypes;

// para la vista fields de views/dashboard/benefits/partials
class OptionsSelectBenefitTypes
{
	public function get()
	{
		$types = BenefitTypes::all();

		$array[''] = '';
		foreach ($types as $value) {
			$array[$value->id] = $value->name;
		}
		return $array;
	}
}