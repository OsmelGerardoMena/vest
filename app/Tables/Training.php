<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
	protected $table = 'trainings';

	protected $fillable = [
            'date',
            'product_id',
            'training_file',
            'content'
    ];

    ///** Mutators **///
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = htmlentities(trim($value));
    }
    
    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, la capacitacion solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

    ///** Filtro para capacitaciones **///
    public static function filterTrainings($product_id)
    {
    	return Training::productid($product_id)->simplePaginate(5);
    }

    ///** Filtro para capacitaciones de los productos de una empresa **///
    public static function filterCompanyTrainings($idCompanyProducts, $product_id)
    {
        return Training::whereIn('product_id', $idCompanyProducts)
                ->productid($product_id)->simplePaginate(5);
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

    // verifica si existe un archivo para la capacitacion
    public function hasFile()
    {
        return \Storage::disk('local_training_file')
                ->exists($this->training_file);
    }
}
