<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

use  Carbon\Carbon;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $fillable = [
            'name',
            'contract_file',
            'product_id'
    ];
   
    ///** relacion de muchos a uno (relacion inversa) **///
    public function product()
    {
        //retorna un solo objeto product, el contrato solo tiene un producto
        return $this->belongsTo('Vest\Tables\Product');
    }

    ///** Filtro para contratos **///
    public static function filterContracts($name, $product_id)
    {
    	return Contract::name($name)
                ->productid($product_id)
                ->simplePaginate(5);
    }

    ///** Filtro para contratos de los productos de una empresa **///
    public static function filterCompanyContracts($idCompanyProducts, $name, $product_id)
    {
        // idCompanyProducts contiene los id de los productos de la empresa logueada
        return Contract::whereIn('product_id', $idCompanyProducts)->name($name)
                ->productid($product_id)
                ->simplePaginate(5);
    }

    ///** Scope **///
    public function scopeName($query, $name)
    {
        if(trim($name) != ""){
            $query->where("name", "LIKE", "%$name%");
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

    // verifica si existe un archivo para el contrato
    public function hasFile()
    {
        return \Storage::disk('local_contract_file')->exists($this->contract_file);
    }
}
