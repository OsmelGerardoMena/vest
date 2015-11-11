<?php

namespace Vest\Services;

use Vest\User;

// Para la vista fields de views/dashboard/sellers/partials
class Companies
{
	public function get()
	{
		// se devuelvel todas las empresas activas
		return User::where('type_id', 3)->where('status_id', 1)->get();
	}
}