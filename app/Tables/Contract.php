<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

use  Carbon\Carbon;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $fillable = [
            'name',
            'file',
            'url',
            'product_id'
    ];

    ///** Mutators **///
    public function setFileAttribute($file)
    {
        $this->attributes['file'] = uniqid('', true).$file->getClientOriginalName();

        $name = uniqid('', true).$file->getClientOriginalName();

        ///\File::get($file);

        \Storage::disk('local')->put('contracts/'.$name, file_get_contents($file));
    }
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
}
