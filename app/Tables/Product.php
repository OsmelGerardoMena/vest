<?php

namespace Vest\Tables;

use Illuminate\Database\Eloquent\Model;

use Vest\User;
use Vest\Tables\CompanyCategories;

class Product extends Model
{
	protected $table = 'products';

    protected $fillable = [
        'name',
        'presentation',
        'price',
        'url',
        'creator',
        'company_id',
    ];

	///** relacion de muchos a uno (relacion inversa) **///
    /*public function creator()
    {
        //retorna un solo objeto creator, ya que el producto solo tiene un creador
        return $this->belongsTo('Vest\User');
    }*/

     public function company()
    {
        // retorna un solo objeto company, ya que el producto solo 
        // pertenece a una empresa
        return $this->belongsTo('Vest\User');
    }

    public function status()
    {
        // retorna un solo objeto status, ya que el producto solo tiene un status
        return $this->belongsTo('Vest\Tables\Status');
    }

    ///** relacion de uno a muchos **///
    public function contracts()
    {
        return $this->hasMany('Vest\Tables\Contract');
    }

    public function benefits()
    {
        return $this->hasMany('Vest\Tables\Benefit');
    }

    public function incentives()
    {
        return $this->hasMany('Vest\Tables\Incentive');
    }

    public function trainings()
    {
        return $this->hasMany('Vest\Tables\Training');
    }
    
    ///** relacion de muchos a muchos **///
    public function sellers()
    {
        //retorna un array de objetos, el producto puede tener varios vendedores
        return $this->belongsToMany('Vest\User')
                    ->withPivot('status');
        //busca en la tabla pivote el campo product_id
    }

    ///** Filtro para productos **///
    public static function filterProducts($name, $company, $category)
    {
        // whereNotIn impide que se muestre el producto general
    	return Product::whereNotIn('id', [1])->name($name)->company($company)
                ->companycategory($category)
                ->simplePaginate(5);
    }

    ///** Filtro para mostrar solo productos activos a los vendedores **///
    public static function filterActiveProducts($name, $company, $category)
    {
        // whereNotIn impide que se muestre el producto general
        return Product::whereNotIn('id', [1])->where('status_id', 1)
                ->name($name)
                ->company($company)
                ->companycategory($category)
                ->simplePaginate(5);
    }

    ///** Filtro para vendedores del producto **///
    public static function filterProductSellers($product, $nameseller)
    {
        // se usa el metodo de sellers() del modelo Product
        // no se puede usar Product::where('id', $product->id)->sellers() porque
        // el método sellers() no es estático
        return $product->sellers()
                    ->nameSeller($nameseller)
                    ->simplePaginate(5);
        // nameseller es un scope del modelo User
    }

    ///** Filtro para productos no asignados a un vendedor **///
    public static function filterProductsUnallocated($seller_id, $name, $company)
    {
        // busco el vendedor
        $seller = User::findOrFail($seller_id);

        // se buscan lso productos del vendedor, almacenando solo los id
        $sellerProducts = $seller->addedproducts()->lists('product_id');

        // devuelvo todos los productos excepto los del vendedor anterior
        return Product::name($name)
                    ->company($company)
                    ->whereNotIn('id', $sellerProducts)
                    ->whereNotIn('id', [1])
                    ->simplePaginate(5);
    }
 
    ///** Scope **///
    public function scopeName($query, $name)
    {
		if(trim($name) != ''){
	        $query->where("name", "LIKE", "%$name%");
	    }    
    }

    public function scopeCompany($query, $company_id)
    {
        if(trim($company_id) != ''){
            $exists_company = User::where('id', $company_id)->exists();
            
            if($exists_company){
                $query->where("company_id", $company_id);
            }
        }
    }

    public function scopeCompanyCategory($query, $category_id)
    {
        if (trim($category_id) != '') {
            $exists_category = CompanyCategories::where('id', $category_id)->exists();

            if ($exists_category) {
                // se alamacenan todos los id de las empresas que pertenecen a la categoría 
                $companies = User::where('company_category_id', $category_id)->lists('id');
                $query->whereIn('company_id', $companies);
            }
        }
    }

    ///** Verifica el status del producto **///
    public function isActive()
    {
        if($this->getStatusId() == 1)
            return true;
        else if($this->getStatusId() == 2)
            return false;
    }

    ///** Devuelve el id del status asignado al producto**///
    public function getStatusId()
    {
        return $this->status->id;
    }

    ///** Devuelve el valor del status asignado al vinculo **///
    public function getLinkStatus()
    {   // true o false
        return $this->pivot->status;
    }
}