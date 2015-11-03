<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $table = 'notifications';

    ///** relacion de muchos a uno (relacion inversa) **///
    public function user()
    {
        // retorna un solo objeto user, ya que la notificacion pertenece a un usuario
        return $this->belongsTo('Vest\User');
    }
}
