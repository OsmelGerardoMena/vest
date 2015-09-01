<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

use Vest\User;

class Product extends Model
{
	protected $table = 'products';

    protected $fillable = [
        'name', 
        'company_id',
        'creator_id',
    ];

	///** relacion de muchos a uno (relacion inversa) **///
    public function creator()
    {
        //retorna un solo objeto creator, ya que el producto solo tiene un creador
        return $this->belongsTo('Vest\User');
    }

     public function company()
    {
        //retorna un solo objeto company, ya que el producto solo pertenece a una empresa
        return $this->belongsTo('Vest\User');
    }

    public function status()
    {
        //retorna un solo objeto status, ya que el producto solo tiene un status
        return $this->belongsTo('Vest\Tables\Status');
    }

     ///** relacion de muchos a muchos **///
    public function users()
    {
        //retorna un array de objetos, el producto puede tener varios usuarios
        return $this->belongsToMany('Vest\User')
    }

    ///** Filtro para productos y Scope **///
    public static function filterProducts($name, $company)
    {
    	return Product::name($name)->company($company)->simplePaginate(5);
    }

    public function scopeName($query, $name)
    {
		if(trim($name) != ""){
	        $query->where("name", "LIKE", "%$name%");
	    }    
    }

    public function scopeCompany($query, $company_id)
    {
    	$users = User::select('id', 'name')->get();

		foreach ($users as $value) {
			$array[$value->id] = $value->name; 
		}

        if($company_id != "" && isset($array[$company_id])){
            
            $query->where("company_id", $company_id);
        }
    }

}
