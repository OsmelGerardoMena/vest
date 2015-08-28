<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    protected $table = 'submodules';

    // relacion muchos a uno (inversa)
    public function module()
    {
    	//retorna un solo objeto, ya que el submodulo pertenece a un solo modulo
    	return $this->belongsTo('Vest\Tables\Module');
    }
}
