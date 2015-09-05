<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $fillable = [
            'name', 
            'url',
            'product_id'
    ];

    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, el contrato solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

    ///** Filtro para usuarios y Scope **///
    public static function filterContracts($name, $product_id)
    {
    	return Contract::name($name)
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
