<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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

    ///** Mutators **///
    public function setDateFromAttribute($date){
        // El metodo guarda la fecha colocada en el formulario con la hora actual
        if(!empty($date)){
            // se crea la fecha actual con la hora actual
            $today = Carbon::now();
            // se verifica si la fehca en today es igual a la que viene desde el 
            // formulario, si es así, se hace el procedimiento para guardar la hora actual
            if ($today->toDateString() == $date) {
                // la fecha que viene del formulario se divide en un string
                // para poder usarlo en el metodo setDate de Carbon
                $date = explode('-', $date);
                // a fecha de hoy se le ingresa con setDate la fecha del formulario
                // para que pueda tener una hora distinta de 00:00:00
                $this->attributes['date_from'] = $today->setDate($date[0], $date[1], $date[2]);
            }
            else {
                // de lo contrario, si date posee otra fecha que no sea la de 
                // today, entonces simplemente guarda date concatenando 00:00:00
                $this->attributes['date_from'] = $date.' 00:00:00';
            } 
        }
    }

    public function setDateToAttribute($date){
        // El metodo guarda la fecha colocada en el formulario con la hora = 23:59:59
        if(!empty($date)){
            $this->attributes['date_to'] = $date.' 23:59:59';
        }
    }

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
