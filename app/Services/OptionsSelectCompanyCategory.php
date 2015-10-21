<?php

namespace Vest\Services;

use Vest\Tables\CompanyCategories;

// para la vista field_category de views/dashboard/companies/partials
class OptionsSelectCompanyCategory
{
	public function get()
	{
		$categories = CompanyCategories::all();

		$array[''] = '';

		foreach ($categories as $category) {
			$array[$category->id] = $category->name;
		}
		
		return $array;
	}
}	