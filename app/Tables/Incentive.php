<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    protected $table = 'incentives';

    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, el incentivo solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

     ///** Filtro para incentivos y Scope **///
    public static function filterIncentives($name, $product_id)
    {
    	return Incentive::name($name)
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
