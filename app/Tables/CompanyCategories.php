<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

class CompanyCategories extends Model
{
    protected $table = 'company_categories';

    protected $fillable = ['name'];
   
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
