<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    ///** relacion de muchos a uno (relacion inversa) **///
    public function seller()
    {
    	$this->belongsTo('Vest\Tables\User'); // un solo vendedor
    }

    public function product()
    {
    	$this->belongsTo('Vest\Tables\Product'); // un solo producto
    }

    public function customer()
    {
    	$this->belongsTo('Vest\Tables\Customer'); // un solo cliente
    }
}
