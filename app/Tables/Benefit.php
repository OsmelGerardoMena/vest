<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $table = 'benefits';

    protected $fillable = [ 'name', 'product_id'];

    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, el contrato solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

    ///** Filtro para usuarios y Scope **///
    public static function filterBenefits($name, $product_id)
    {
    	return Benefit::name($name)
                ->productid($product_id)
                ->simplePaginate(5);
    }

    public function scopeName($query, $name)
    {
        if(trim($name) != ""){
            $query->where("name", "LIKE", "%$name%");
        }    
    }

    public function scopeProductid($query, $product_id)
    {
        $products = Product::select('id')->where('status_id', 1)->get();

        $array = [];
        
        foreach ($products as $product) {
            $array[$product->id] = $product->id;
        }

        if($product_id != "" && isset($array[$product_id])){
      		$query->where("product_id", $product_id);
        }
    }
}
