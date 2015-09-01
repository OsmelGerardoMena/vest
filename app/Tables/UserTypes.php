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

    ///** Filtro para perfiles y Scope **///
    public static function filterProfiles($name)
    {
    	return UserTypes::whereNotIn('id', [1])
                    ->name($name)
                    ->simplepaginate(5);
    }

    public function scopeName($query, $name)
    {
    	 if(trim($name) != ""){
            $query->where("name", "LIKE", "%$name%");
        }  
    }

    //devuleve true si encuentra el id en activated_submodules
    public function submoduleExists($id)
    {
        $submodules = explode(',', $this->activated_submodules);

        return in_array($id, $submodules);
    }
}