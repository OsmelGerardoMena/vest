<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
	protected $table = 'trainings';

	protected $fillable = [
            'url',
            'date',
            'product_id'
    ];

    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, la capacitacion solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

     ///** Filtro para capacitaciones y Scope **///
    public static function filterTrainings($product_id)
    {
    	return Training::productid($product_id)->simplePaginate(5);
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
