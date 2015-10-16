<?php

namespace Vest\Services;

use Vest\Tables\Module;
use Vest\Tables\Submodule;

// Para la vista modules de views/partials
class OptionsMenu
{
	public function options()
	{
		$user = \Auth::user();

		//obtengo los id de los modulos del perfil del usuario
		$modules = explode(',', $user->type->activated_modules);
		//se guardan en un array de string

		//obtengo los id de submodulos del perfil del usuario
		$submodules = explode(',', $user->type->activated_submodules);

		//recorro el array de string modules
		foreach ($modules as $value) {
			//obtengo el modulo (value es el id)
			$module = Module::find($value);
			
			//recorro los submodules para guardarlos en un array
			foreach ($submodules as $id) {
				$submodule = Submodule::find($id);

				//tambien se puede usar $submodule->module->id por la relacion de tablas
				if($module->id == $submodule->module_id){
						$submoduleArray [] = [
						'description' => $submodule->description,
						'url' => $submodule->url,
					];
				}
			}

			//se rellena el array final
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