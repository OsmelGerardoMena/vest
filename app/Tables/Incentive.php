<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    protected $table = 'incentives';

    protected $fillable = [
        'incentive_type_id',
        'goal', 
        'award',
        'date_from',
        'date_to',
        'product_id',
    ];

    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, el incentivo solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

    public function type()
    {
        //retorna un solo objeto incentive_type, el incentivo solo tiene un tipo
        return $this->belongsTo('Vest\Tables\IncentiveTypes', 'incentive_type_id');
        // En relacion inversa, Eloquent asume que en Incentive existe un campo 
        // llamado type_id, pero eso no es cierto por lo tanto se le pasa el
        // segundo parametro que indica la verdadera llave foranea
    }

    ///** Filtro para incentivos **///
    public static function filterIncentives($award, $product_id)
    {
    	return Incentive::name($award)
                ->productid($product_id)
                ->simplePaginate(5);
    }

    ///** Filtro para incentivos de los productos de una empresa **///
    public static function filterCompanyIncentives(
        $idCompanyProducts, $award, $product_id)
    {
        return Incentive::whereIn('product_id', $idCompanyProducts)
                ->name($award)
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
        $products = Product::select('id')->get();

        $array = [];
        
        foreach ($products as $product) {
            $array[$product->id] = $product->id;
        }

        if($product_id != "" && isset($array[$product_id])){
            
            $query->where("product_id", $product_id);
        }
    }

    // verifica si existe una imagen (file) para el incentivo
    public function hasFile()
    {
        return \Storage::disk('local_incentive_img')->exists($this->img);
    }
}
