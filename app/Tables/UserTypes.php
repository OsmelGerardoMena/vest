<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    protected $table = 'user_types';

    ///** relacion de muchos a uno (relacion inversa) **///
    public function status()
    {
        //retorna un solo objeto, ya que el usuario solo tiene un status
        return $this->belongsTo('Vest\Tables\Status');
    }

    ///** Filtro para perfiles **///
    public static function filterProfiles($name)
    {
        //id: 1, 2, 3 son de admin, seller y company no deben ser borrados
    	return UserTypes::whereNotIn('id', [1])
                    ->name($name)
                    ->simplePaginate(5);
    }

    ///** Scope **///
    public function scopeName($query, $name)
    {
    	 if(trim($name) != ""){
            $query->where("name", "LIKE", "%$name%");
        }  
    }

    //devuelve true si encuentra el id en activated_submodules
    public function submoduleExists($id)
    {
        $submodules = explode(',', $this->activated_submodules);

        return in_array($id, $submodules);
    }

    ///** Devuelve el id del status asignado **///
    public function getStatusId()
    {
        return $this->status->id;
    }

    ///** Verifica el status del perfil **///
    public function isActive()
    {
        if($this->getStatusId() == 1)
            return true;
        else if($this->getStatusId() == 2)
            return false;
    }
}