<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
            'name', 
            'address',
            'identifier',
            'city',
            'state',
    ];

    ///** Relacion de uno a muchos **///
    public function sales()
    {
        return $this->hasMany('Vest\Tables\Sale');
    }
    
    ///** Retorna el status del cliente **///
    public function getStatus()
    {
    	return $this->status;
    }

    ///** Filtro para clientes **///
    public static function filterCustomers($name)
    {
        return Customer::name($name)->simplePaginate(5);
    }

    ///** Scope **///
    public function scopeName($query, $name)
    {
    	if(trim($name) != ""){
            $query->where("name", "LIKE", "%$name%");
        } 
    }
}
