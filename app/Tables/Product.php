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
        //retorna un solo objeto company, ya que el producto solo 
        //pertenece a una empresa
        return $this->belongsTo('Vest\User');
    }

    public function status()
    {
        //retorna un solo objeto status, ya que el producto solo tiene un status
        return $this->belongsTo('Vest\Tables\Status');
    }

    ///** relacion de muchos a muchos **///
    public function sellers()
    {
        //retorna un array de objetos, el producto puede tener varios vendedores
        return $this->belongsToMany('Vest\User');
        //busca en la tabla pivote el campo product_id
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
    	$users = User::select('id')->get();

		foreach ($users as $value) {
			$array[$value->id] = $value->id; 
		}

        if($company_id != "" && isset($array[$company_id])){
            
            $query->where("company_id", $company_id);
        }
    }

}
