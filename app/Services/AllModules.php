<?php

namespace Vest\Services;

use Vest\Tables\Module;
use Vest\User;

class AllModules
{
	public function get()
	{
		$user = User::find(1); //para obtener el super admin con id 1

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
					'id' => $submodule->id,
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