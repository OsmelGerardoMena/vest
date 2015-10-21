<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $table = 'benefits';

    protected $fillable = [ 'amount', 'benefit_type_id', 'product_id'];

    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, el beneficio solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

    ///** relacion de muchos a uno (relacion inversa) **///
    public function type()
    {
        //retorna un solo objeto type, el beneficio solo tiene un tipo
        return $this->belongsTo('Vest\Tables\BenefitTypes', 'benefit_type_id');
        // En relacion inversa, Eloquent asume que en Benefit existe un campo 
        // llamado type_id, pero eso no es cierto por lo tanto se le pasa el
        // segundo parametro que indica la verdadera llave foranea
    }

    ///** Filtro para beneficios **///
    public static function filterBenefits($product_id, $idCompanyProducts = [])
    {
    	return Benefit::productid($product_id)->simplePaginate(5);
    }

    ///** Filtro para beneficios de los productos de una empresa **///
    public static function filterCompanyBenefits($idCompanyProducts, $product_id)
    {
        return Benefit::whereIn('product_id', $idCompanyProducts)
                ->productid($product_id)
                ->simplePaginate(5);
    }

    ///** Scope **///
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
}
