<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';

    // relacion uno a muchos
    public function submodules()
    {
    	//retorna un array de objetos ya que un modulo tiene varios submodulos
    	return $this->hasMany('Vest\Tables\Submodule');
    }

}