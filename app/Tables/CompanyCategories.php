<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class CompanyCategories extends Model
{
    protected $table = 'company_categories';

    protected $fillable = ['name'];

    ///** relacion de uno a muchos **///
    public function companies()
    {
        // retorna un array de objetos, una categoría puede pertenecer a muchas empresas
        return $this->hasMany('Vest\User', 'company_category_id');
        // Eloquent busca en User el campo company_category_id (llave foranea)
    }
   
    ///** Filtro para categorias de las empresas **///
    public static function filterCompanyCategories($name)
    {
    	return CompanyCategories::name($name)->simplePaginate(5);
    }

    ///** Scope **///
    public function scopeName($query, $name)
    {
        if(trim($name) != ""){
            $query->where("name", "LIKE", "%$name%");
        }    
    }
}
