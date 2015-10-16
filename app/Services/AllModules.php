<?php

namespace Vest\Services;

use Vest\Tables\Module;

// Para la vista fields y fields_edit de views/dashboard/profiles/partials
class AllModules
{
	public function get()
	{
		//obtengo todos los modulos
		$modules = Module::get();

		//recorro el array de objetos modules
		foreach ($modules as $module) {
			
			//obtengo los submodulos (en un array de submodulos)
			$submodules = $module->submodules;

			//recorro los submodules para obtener cada submodulo
			foreach ($submodules as $submodule) {
				$submoduleArray [] = [
					'id' => $submodule->id,
					'description' => $submodule->description,
				];
			}

			$options[] = [
					'description' => $module->description,
					'submodule' => $submoduleArray,
			];

			$submoduleArray = [];
		}

		return $options;
	}
}