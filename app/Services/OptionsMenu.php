<?php

namespace Vest\Services;

use Vest\Tables\Module;

class OptionsMenu
{
	public function options()
	{
		$user = \Auth::user();

		//obtengo los id de los modulos del perfil del usuario
		$modules = explode(',', $user->type->activated_modules);
		//se guardan en un array de string

		//recorro el array de string modules
		foreach ($modules as $value) {
			//obtengo el modulo (value es el id)
			$module = Module::find($value);
			
			//obtengo los submodulos (en un array de submodulos)
			$submodules = $module->submodules;

			//recorro los submodules para obtener cada submodulo
			foreach ($submodules as $submodule) {
				$submoduleArray [] = [
					'description' => $submodule->description,
					'url' => $submodule->url,
				];
			}

			$options[] = [
					'description' => $module->description,
					'icon' => $module->icon,
					'submodule' => $submoduleArray,
			];

			$submoduleArray = [];
		}

		return $options;
	}
}