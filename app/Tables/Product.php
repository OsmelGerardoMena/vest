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

    ///** relacion de uno a muchos **///
    public function contracts()
    {
        return $this->hasMany('Vest\Tables\Contract');
    }

    public function benefits()
    {
        return $this->hasMany('Vest\Tables\Benefit');
    }

    public function incentives()
    {
        return $this->hasMany('Vest\Tables\Incentive');
    }

    public function trainings()
    {
        return $this->hasMany('Vest\Tables\Training');
    }
    ///** relacion de muchos a muchos **///
    public function sellers()
    {
        //retorna un array de objetos, el producto puede tener varios vendedores
        return $this->belongsToMany('Vest\User')
                    ->withPivot('status');
        //busca en la tabla pivote el campo product_id
    }

    ///** Filtro para productos **///
    public static function filterProducts($name, $company)
    {
    	return Product::name($name)->company($company)->simplePaginate(5);
    }

    ///** Scope **///
    public function scopeName($query, $name)
    {
		if(trim($name) != ""){
	        $query->where("name", "LIKE", "%$name%");
	    }    
    }

    public function scopeCompany($query, $company_id)
    {
        // type_id = 3 es el id para las empresas 
    	$users = User::select('id')->where('type_id', 3)->get();

		foreach ($users as $value) {
			$array[$value->id] = $value->id; 
		}

        if($company_id != "" && isset($array[$company_id])){
            
            $query->where("company_id", $company_id);
        }
    }

    ///** Filtro para vendedores del producto **///
    public static function filterProductSellers($id, $namemail)
    {
        //se busca el producto con findOrFail para poder llamar a ->sellers()
        $product = Product::findOrFail($id);
        //ya que no es un metodo estatico y no se puede usar ::sellers()
        return $product->sellers()
                    ->namemailFilter($namemail)
                    ->simplePaginate(5);
    }
}
