<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    protected $table = 'incentives';

    protected $fillable = [
            'goal', 
            'award',
            'url',
            'date',
            'product_id',
    ];

    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, el incentivo solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

    ///** Filtro para incentivos y Scope **///
    public static function filterIncentives($award, $product_id)
    {
    	return Incentive::name($award)
                ->productid($product_id)
                ->simplePaginate(5);
    }

    ///** Scope **///
    public function scopeName($query, $award)
    {
        if(trim($award) != ""){
            $query->where("award", "LIKE", "%$award%");
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
