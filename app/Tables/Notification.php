<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $table = 'notifications';

	//protected $fillable = ['title', 'content', 'user_id'];

    ///** relacion de muchos a uno (relacion inversa) **///
    public function user()
    {
        // retorna un solo objeto user, ya que la notificacion pertenece a un usuario
        // a un solo vendedor
        return $this->belongsTo('Vest\User');
    }

    public function incentive()
    {
        // retorna un solo objeto incentive, ya que la notificacion posee un
        // un solo incentivo
        return $this->belongsTo('Vest\Tables\Incentive');
    }
}
